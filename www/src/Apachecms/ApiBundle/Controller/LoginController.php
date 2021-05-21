<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Apachecms\BackendBundle\Entity\CustomerTransaction;
use Apachecms\BackendBundle\Form\User\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Form\Login\ForgotType;
use Apachecms\BackendBundle\Form\Login\LoginType;
use Apachecms\BackendBundle\Form\Login\RecoverType;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Apachecms\BackendBundle\Form\Customer\CustomerType;
use Apachecms\BackendBundle\Form\Login\LoginByGoogleType;
use Apachecms\BackendBundle\Form\Login\LoginByFacebookType;
use Apachecms\BackendBundle\Form\Customer\UsernameType;
use Apachecms\BackendBundle\Form\Customer\CustomerExtraType;
use Apachecms\BackendBundle\Entity\Customer;
use Symfony\Component\Filesystem\Filesystem;

class LoginController extends BaseController{

    public function __construct(){

    }

    public function loginAction(Request $request){
        $form=$this->createForm(LoginType::class, null,array('action'=>$this->generateUrl('apachecms_api_login_submit'),'method' => 'POST'));
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array('email'=>$form->get('_username')->getData(),'isDelete'=>false));
            if(!$entity)
                throw new Exception(null,200);

            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($entity);
            if(!$encoder->isPasswordValid($entity->getPassword(), $form->get('_password')->getData(), $entity->getSalt()))
                throw new Exception(null,200);

            $token = new UsernamePasswordToken($entity, $form->get('_password')->getData(), "main", $entity->getRoles());
            $this->get("security.token_storage")->setToken($token);
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            
            return $this->responseOk(array('from'=>'apachecms_api_login_submit','to'=>$this->generateUrl('apachecms_frontend_dashboard')));
        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans('invalid.credentials'),'data'=>null)),200);
        }
        
    }
    
    public function selectPlanAction($customer,$plan,$trial,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $customer=$this->get('security.token_storage')->getToken()->getUser();
            $planEntity=$em->getRepository('ApachecmsBackendBundle:Plan')->find($plan);
            $customer->setPlan($planEntity);
            $customer->setUseTrial($trial);
            $customer->setUrlDestination(json_encode(array('url'=>'security_frontend_profile','params'=>array())));
            
            $em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->deleteAll($customer->getId());
            $transaction = new CustomerTransaction($planEntity,$trial,$customer,1);
            $em->persist($transaction);
            
            $em->persist($customer);
            $em->flush();           
            return $this->responseOk(array('to'=>$this->generateUrl('security_frontend_profile')));
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
    }
    
    public function profileAction(Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $entity=$this->get('security.token_storage')->getToken()->getUser();
            $form=$this->createForm(CustomerExtraType::class, $entity);
            $form->handleRequest($request);
            if($errors=$this->ifErrors($form)) return $errors;
        
            $entity->setUrlDestination(json_encode(array('url'=>'security_frontend_username','params'=>array())));
            $em->persist($entity);
            $em->flush();
            return $this->responseOk(array('to'=>$this->generateUrl('security_frontend_username')));
           
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
    }
    
    public function usernameAction(Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $entity=$this->get('security.token_storage')->getToken()->getUser();
            $form=$this->createForm(UsernameType::class, $entity);
            $form->handleRequest($request);
            if($errors=$this->ifNotValidUsername($form)) return $errors;

            $entity->setUrlDestination(null);
            $entity->setProfileIsComplete(true);
            $output = shell_exec($this->get('kernel')->getRootDir().DIRECTORY_SEPARATOR.'script.sh '.$form->get('usernameUrl')->getData().' '.$this->get('kernel')->getRootDir().'/../src/Apachecms/FrontendBundle/Resources/config/dinamic.yml');

            $em->persist($entity);
            $em->flush();
            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_dashboard')));
           
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
    }
    
    protected function ifNotValidUsername($form){
        $permitidos = "abcdefghijklmnopqrstuvwxyz-_0123456789";
        $wordsReserved=array(
            'js',
            '_wdt',
            '_profiler',
            '_error',
            'validate',
            'landing',
            'changeLocale',
            'dashboard',
            'iniciarSesion',
            'login',
            'dashboard',
            'pay',
            'api',
            'fp_js_form_validator',
            'admin',
        );
        $characterNotValid=array();
        $username=$form->get('usernameUrl')->getData();
        $len=strlen($form->get('usernameUrl')->getData());
        if(in_array($username,$wordsReserved))
            return $this->responseFail(array('property'=>'usernameUrl','code'=>'character_not_valid','message'=>$this->get('translator')->trans('words.reserved'),'data'=>null),200);
        if($len>24)
            return $this->responseFail(array('property'=>'usernameUrl','code'=>'character_not_valid','message'=>$this->get('translator')->trans('very.long'),'data'=>null),200);
        if($len<2)
            return $this->responseFail(array('property'=>'usernameUrl','code'=>'character_not_valid','message'=>$this->get('translator')->trans('very.short'),'data'=>null),200);
        
        for ($i=0; $i<$len; $i++){ 
            $character=mb_substr($form->get('usernameUrl')->getData(),$i,1);
            if (!empty($character) && strpos($permitidos, $character)===false) 
                $characterNotValid[]=$character;
        }
        
        if(count($characterNotValid)>0){
            $data = array_unique($characterNotValid);
            return $this->responseFail(array('property'=>'usernameUrl','code'=>'character_not_valid','message'=>$this->get('translator')->trans('characters.not.valid').'"'.join(',',$data).'"','data'=>null),200);
        } 

        if($entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->usernameAvailable(
            $form->get('usernameUrl')->getData(), $this->get('security.token_storage')->getToken()->getUser()->getId()
            )->getQuery()->getResult()){
            return $this->responseFail(array('property'=>'usernameUrl','code'=>'character_not_valid','message'=>$this->get('translator')->trans('username.exist'),'data'=>null),200);
        }
    }

    public function registerAction(Request $request,UserPasswordEncoderInterface $passwordEncoder){
        $entity= new Customer();
        $form=$this->createForm(CustomerType::class,$entity);
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            $password = $passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
            $entity->setPassword($password);
            $entity->setCodeActive(md5(md5(uniqid().uniqid())));
            $entity->setIsActive(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // $message = (new \Swift_Message($this->getParameter('title').' - '.$this->get('translator')->trans('welcome')))
            // ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            // ->setTo($entity->getEmail())
            // ->setReplyTo($this->getParameter('no.reply'))
            // ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Register/welcomeAndActive.html.twig', array('entity' => $entity)),'text/html');
            // $this->get('mailer')->send($message); 

            $token = new UsernamePasswordToken($entity, $entity->getPlainPassword(), "main", $entity->getRoles());
            $this->get("security.token_storage")->setToken($token);
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            $username=explode('@',$entity->getEmail());
            $entity->setUsernameUrl($username[0]);
            
            $entity->setUrlDestination(json_encode(array('url'=>'security_frontend_selectPlan','params'=>array('id'=>$entity->getId()))));
            $em->persist($entity);
            $em->flush();
            
            return $this->responseOk(array('from'=>'apachecms_api_login_create_submit','to'=>$this->generateUrl('apachecms_frontend_dashboard')));
        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans('invalid.credentials'),'data'=>null)),200);
        }
        
    }

    public function loginByFacebookAction(Request $request,UserPasswordEncoderInterface $passwordEncoder){
        $form=$this->createForm(LoginByFacebookType::class, null);
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array(
                'email'=>$form->get('email')->getData(),
                'isDelete'=>false));
            if(!$entity){
                $em = $this->getDoctrine()->getManager();
                $entity=new Customer();
                $password = $passwordEncoder->encodePassword($entity, $form->get('facebookId')->getData());
                $entity->setFirstName($form->get('firstName')->getData());
                $entity->setLastName($form->get('lastName')->getData());
                $entity->setEmail($form->get('email')->getData());
                $entity->setFacebookId($form->get('facebookId')->getData());
                $entity->setPassword($password);
                $entity->setCodeActive(md5(md5(uniqid().uniqid())));
                $entity->setIsActive(true);
                $entity->setIsValidate(true);
                $username=explode('@',$entity->getEmail());
                $entity->setUsernameUrl($username[0]);
                $em->persist($entity);
                $em->flush();

                $entity->setUrlDestination(json_encode(array('url'=>'security_frontend_selectPlan','params'=>array('id'=>$entity->getId()))));
                $em->persist($entity);
                $em->flush();
                $message = (new \Swift_Message($this->getParameter('title').' - '.$this->get('translator')->trans('welcome')))
                ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
                ->setTo($entity->getEmail())
                ->setReplyTo($this->getParameter('no.reply'))
                ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Register/welcome.html.twig', array('entity' => $entity)),'text/html');
                $this->get('mailer')->send($message); 
            }elseif($entity->getFacebookId()!=$form->get('facebookId')->getData()){
                return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>'El email NO está registrado con una cuenta de Facebook válida.','data'=>null)),200);
            }
            
            if($entity->getIsLocked())
                return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans($entity->getLockedDescription()),'data'=>null)),200);

            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($entity);
            if(!$encoder->isPasswordValid($entity->getPassword(), $form->get('facebookId')->getData(), $entity->getSalt()))
                throw new Exception(null,200);

            $token = new UsernamePasswordToken($entity, $form->get('facebookId')->getData(), "main", $entity->getRoles());
            $this->get("security.token_storage")->setToken($token);
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            
            return $this->responseOk(array('from'=>'apachecms_api_login_submit','to'=>$this->generateUrl('apachecms_frontend_dashboard')));
        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans('invalid.credentials'),'data'=>null)),200);
        }
        
    }
    
    public function loginByGoogleAction(Request $request,UserPasswordEncoderInterface $passwordEncoder){
        $form=$this->createForm(LoginByGoogleType::class, null);
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array(
                'email'=>$form->get('email')->getData(),
                'isDelete'=>false));
            if(!$entity){
                $em = $this->getDoctrine()->getManager();
                $entity=new Customer();
                $password = $passwordEncoder->encodePassword($entity, $form->get('googleId')->getData());
                $entity->setFirstName($form->get('firstName')->getData());
                $entity->setLastName($form->get('lastName')->getData());
                $entity->setEmail($form->get('email')->getData());
                $entity->setGoogleId($form->get('googleId')->getData());
                $entity->setPassword($password);
                $entity->setCodeActive(md5(md5(uniqid().uniqid())));
                $entity->setIsActive(true);
                $entity->setIsValidate(true);
                $username=explode('@',$entity->getEmail());
                $entity->setUsernameUrl($username[0]);
                $em->persist($entity);
                $em->flush();

                $entity->setUrlDestination(json_encode(array('url'=>'security_frontend_selectPlan','params'=>array('id'=>$entity->getId()))));
                $em->persist($entity);
                $em->flush();
                $message = (new \Swift_Message($this->getParameter('title').' - '.$this->get('translator')->trans('welcome')))
                ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
                ->setTo($entity->getEmail())
                ->setReplyTo($this->getParameter('no.reply'))
                ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Register/welcome.html.twig', array('entity' => $entity)),'text/html');
                $this->get('mailer')->send($message); 
            }elseif($entity->getGoogleId()!=$form->get('googleId')->getData()){
                return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>'El email NO está registrado con una cuenta de Google válida.','data'=>null)),200);
            }
            
            if($entity->getIsLocked())
                return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans($entity->getLockedDescription()),'data'=>null)),200);

            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($entity);
            if(!$encoder->isPasswordValid($entity->getPassword(), $form->get('googleId')->getData(), $entity->getSalt()))
                throw new Exception(null,200);

            $token = new UsernamePasswordToken($entity, $form->get('googleId')->getData(), "main", $entity->getRoles());
            $this->get("security.token_storage")->setToken($token);
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            
            return $this->responseOk(array('from'=>'apachecms_api_login_submit','to'=>$this->generateUrl('apachecms_frontend_dashboard')));
        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'_username','code'=>'invalid_credentials','message'=>$this->get('translator')->trans('invalid.credentials'),'data'=>null)),200);
        }
        
    }
    public function usernameCheckAction(Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $entity=$this->get('security.token_storage')->getToken()->getUser();
            $form=$this->createForm(UsernameType::class, $entity);
            $form->handleRequest($request);
            if($errors=$this->ifNotValidUsername($form)) return $errors;
            return $this->responseOk(array('to'=>$this->generateUrl('security_frontend_username')));
           
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
    }

    
    public function recoveryAction(Request $request){
        $form=$this->createForm(ForgotType::class,null,array('method' => 'POST','action'=>$this->generateUrl('apachecms_api_login_recovery_submit')));
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            if(!$entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array('email'=>$form->get('email')->getData(),'isDelete'=>false)))
                throw new Exception(null,200);
            $em=$this->getDoctrine()->getManager();
            $entity->setCodeActive(md5(md5(uniqid().uniqid())));
            $em->persist($entity);
            $em->flush();
            $message = (new \Swift_Message($this->getParameter('title').' - '.$this->get('translator')->trans('reset.password')))
            ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            ->setTo($entity->getEmail())
            ->setReplyTo($this->getParameter('no.reply'))
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Login/forgotPassword.html.twig', array(
                'entity' => $entity,
                'resetUrl'=>'security_reset_password_frontend')),'text/html');
            $this->get('mailer')->send($message);
            return $this->responseOk(array('from'=>'apachecms_api_login_recovery_submit'));

        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'email','code'=>'email_not_found','message'=>$this->get('translator')->trans('email.not.found'),'data'=>null)),200);
        }
        
    }

    
    public function resetAction($id,$code,Request $request,UserPasswordEncoderInterface $passwordEncoder){
        $form=$this->createForm(RecoverType::class, null,array('action'=>$this->generateUrl('security_reset_password_frontend_submit',array('id'=>$id,'code'=>$code)),'method' => 'POST'));
        $form->handleRequest($request);
        if($errors=$this->ifErrors($form)) return $errors;
        try {
            $em=$this->getDoctrine()->getManager();
            if(!$entity = $em->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array('id'=>$id,'codeActive'=>$code)))
                throw new Exception(null,200);

            $password = $passwordEncoder->encodePassword($entity, $form->get('plainPassword')->getData());
            $entity->setPassword($password);
            $entity->setCodeActive(md5(md5(uniqid().uniqid())));
            $em->persist($entity);
            $em->flush();
            $this->addFlash("success",$this->get('translator')->trans('reset.password.success'));
            return $this->responseOk('OK');

        }catch (Exception $excepcion) {
            return $this->responseFail(array(array('property'=>'email','code'=>'email_not_found','message'=>$this->get('translator')->trans('email.not.found'),'data'=>null)),200);
        }
        
    }
    
}
