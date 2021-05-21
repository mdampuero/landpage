<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Apachecms\BackendBundle\Form\Customer\CustomerExtraType;

class AccountController extends BaseController{
    
    
    public function profileAction(Request $request){
        $entity=$this->get('security.token_storage')->getToken()->getUser();
        $form=$this->createForm(CustomerExtraType::class,$entity,array(
            'method' => 'POST',
            'action'=>$this->generateUrl('apachecms_api_account_submit')));
        $form->add('email',EmailType::class,array('label'=>'form.email','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')));
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            $em=$this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->responseOk(array('from'=>'apachecms_api_login_submit'));
        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans('invalid.credentials'),'data'=>null)),200);
        }
        
    }
    
    public function getContactsAction(){
        return $this->responseOk($this->get('security.token_storage')->getToken()->getUser()->getContacts());
    }
    
    public function needHelpAction(Request $request){
        try {
            $message = (new \Swift_Message('Un usuario necesita ayuda'))
            ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            ->setTo($this->getParameter('mailer_user'))
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Help/needHelp.html.twig', array(
                'customer' => $this->get('security.token_storage')->getToken()->getUser(),
                'query'=>$request->get('query')
                )),'text/html');
            $this->get('mailer')->send($message);
            return $this->responseOk('OK');
        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'email','code'=>'email_not_found','message'=>$this->get('translator')->trans('email.not.found'),'data'=>null)),200);
        }
    }
    public function reSendEmailValidateAction(){
        try {
            $entity=$this->get('security.token_storage')->getToken()->getUser();
            $message = (new \Swift_Message($this->getParameter('title').' - '.$this->get('translator')->trans('validate.email')))
            ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            ->setTo($entity->getEmail())
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Account/validateEmail.html.twig', array('entity' => $entity)),'text/html');
            $this->get('mailer')->send($message);
            return $this->responseOk($entity);
        }catch (Exception $excepcion) {
            return $this->responseFail();
        }
    }
    
}
