<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Entity\Stat;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\StatMessage;
use Symfony\Component\HttpFoundation\Session\Session;
use Apachecms\BackendBundle\Entity\LandingContact;
use Apachecms\BackendBundle\Entity\Notification;

class ChatbotController extends BaseController{
 
    public $session;

    public function __construct(){
        $this->session = new Session();
    }

    public function sendAction(Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $stat=$em->getRepository('ApachecmsBackendBundle:Stat')->find($request->get('stat')['id']);
            $message=new StatMessage();
            $message->setUserFrom('User');
            $message->setStat($stat);
            $message->setMessage($request->get('message'));
            $em->persist($message);
            
            $response=$this->analiceQuestion($request->get('message'),$stat,$request->get('testOption'));
            if(!$response) throw new Exception("Error Processing Request", 1);
            
            $message=new StatMessage();
            $message->setUserFrom('Bot');
            $message->setStat($stat);
            $message->setMessage($response);
            $em->persist($message);

            $em->flush();
            
            return $this->responseOk($response);
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage());
        }
    }  
    protected function extract_emails($str){
        $regexp = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
        preg_match_all($regexp, $str, $m);    
        return isset($m[0]) ? $m[0] : array();
    }

    protected function addContact($data=array(),$stat,$testOption=null){
        $landing=$stat->getLandingId();
        $em=$this->getDoctrine()->getManager();
        if(key_exists('email',$data) && $data['email']){
            if(!$contact=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingContact')->findOneBy(array(
                'email'=>$data['email'],
                'customer'=>$landing->getCustomer(),
            ))){
                $contact=new LandingContact();
                $contact->setCustomer($landing->getCustomer());
                $contact->setLanding($landing);
                $contact->setName('Anónimo');
            }
            $contact->setEmail($data['email']);
        }
        
        if(key_exists('phone',$data) && $data['phone']){
            if(!$contact=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingContact')->findOneBy(array(
                'phone'=>$data['phone'],
                'customer'=>$landing->getCustomer(),
            ))){
                $contact=new LandingContact();
                $contact->setCustomer($landing->getCustomer());
                $contact->setLanding($landing);
                $contact->setName('Anónimo');
            }
            $contact->setPhone($data['phone']);
        }
        $contact->setType('Chatbot');   
        
        /* BEGIN SEND NOTIFICATION */
        $notifications = $this->get('notifications')->send(array(
            'title'=>'Nuevo contacto desde el Chatbot',
            'description'=>'Tienes un nuevo contacto de "'.$landing->getTitle().'"',
            'type'=>'Chatbot',
            'path'=>$this->generateUrl('apachecms_frontend_landing_chats_view',array('id'=>$landing->getId(),'queryId'=>$stat->getId())),
            'typeId'=>$stat->getId(),
            'customer'=>$landing->getCustomer(),
            'landing'=>$landing,
            'link'=>$this->generateUrl('apachecms_frontend_notifications')
        ));
        /* END SEND NOTIFICATION */

        $landing->setLeads($landing->getLeads()+1);
        $landing->setConvertions();
        
        $stat->setValidLead(true);
        $stat->setContact($contact);
        $em->persist($stat);
        
        if($testOption){
            $testOption=$em->getRepository('ApachecmsBackendBundle:LandingTestOption')->find($testOption);
            $testOption->setLeads($testOption->getLeads()+1);
            $testOption->setConvertions();
            $em->persist($testOption);
        }

        $em->persist($contact);
        $em->flush();
    }
    protected function analiceQuestion($question,$stat,$testOption=null){
        $setting = $this->get('setting')->getData();
        if ($this->session->get('chatbot')['type']!='finish') {
            $question=strtolower($question);
            $words=explode(' ', $question);

            $saludos=explode(',',$setting->getNotUsePhoneTrigger());
            foreach ($saludos as $key => $saludo) {
                $pos = strpos($question, $saludo);
                if ($pos !== false) {
                    if ($this->session->get('chatbot')['type']=='phone') {
                        $this->session->set('chatbot', array('type'=>'email','intentos'=>0));
                        return $setting->getNotUsePhoneResponse();
                    }
                }
            }

            if ($this->session->get('chatbot')['type']=='phone') {
                $sessionChat=$this->session->get('chatbot');
                if ($sessionChat['intentos']<2) {
                    preg_match('/\d{7,}/', $question, $phone);
                    $phone=current($phone);
                    if ($phone) {
                        $this->session->set('chatbot', null);
                        $this->session->set('chatbot', array('type'=>'finish','intentos'=>0));
                        $this->addContact(array('phone'=>$phone),$stat,$testOption);
                        return nl2br($stat->getLandingId()->getContactReplyEmail());
                    } else {
                        $sessionChat['intentos']++;
                        $this->session->set('chatbot', $sessionChat);
                        return $setting->getPhoneNotValid();
                    }
                } else {
                    $this->session->set('chatbot', array('type'=>'email','intentos'=>0));
                    return $setting->getNotUsePhoneResponse();
                }
            }

            if ($this->session->get('chatbot')['type']=='email') {
                $sessionChat=$this->session->get('chatbot');
                if ($sessionChat['intentos']<2) {
                    $email=current($this->extract_emails($question));
                    if ($email) {
                        $this->session->set('chatbot', null);
                        $this->session->set('chatbot', array('type'=>'finish','intentos'=>0));
                        $this->addContact(array('email'=>$email),$stat,$testOption);
                        return nl2br($stat->getLandingId()->getContactReplyEmail());
                    } else {
                        $sessionChat['intentos']++;
                        $this->session->set('chatbot', $sessionChat);
                        return $setting->getEmailNotValid();
                    }
                } else {
                    $this->session->set('chatbot', null);
                }
            }
            /* SALUDOS */
            $saludos=explode(',',$setting->getGreetingSecondTrigger());
            foreach ($saludos as $key => $saludo) {
                $pos = strpos($question, $saludo);
                if ($pos !== false) {
                    $this->session->set('chatbot', null);
                    return $setting->getGreetingSecondResponse();
                }
            }
        
            /* MAS INFO */
            $saludos=explode(',',$setting->getMoreInfoTrigger());
            foreach ($saludos as $key => $saludo) {
                $pos = strpos($question, $saludo);
                if ($pos !== false) {
                    $this->session->set('chatbot', array('type'=>'phone','intentos'=>0));
                    return $setting->getMoreInfoResponse();
                }
            }
        
            /* COTIZACIÓN */
            $saludos=explode(',',$setting->getMorePriceTrigger());
            foreach ($saludos as $key => $saludo) {
                $pos = strpos($question, $saludo);
                if ($pos !== false) {
                    $this->session->set('chatbot', array('type'=>'phone','intentos'=>0));
                    return $setting->getMorePriceResponse();
                }
            }

            $this->session->set('chatbot', null);
            return $setting->getNotUnderstand();
        }else{
            return null;
        }
    }
    
}
