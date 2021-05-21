<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;

use Apachecms\BackendBundle\Form\Login\LoginType;
use Apachecms\BackendBundle\Form\Login\ForgotType;
use Apachecms\BackendBundle\Form\Login\RecoverType;
use Apachecms\BackendBundle\Form\Customer\CustomerType;
use Apachecms\BackendBundle\Form\Login\LoginByFacebookType;
use Apachecms\BackendBundle\Form\Login\LoginByGoogleType;
use Apachecms\BackendBundle\Form\Customer\CustomerExtraType;
use Apachecms\BackendBundle\Form\Customer\UsernameType;
use Apachecms\FrontendBundle\Form\Login\SiteType;
use Apachecms\BackendBundle\Entity\Customer;

use Symfony\Component\Validator\Constraints as Assert;

class LoginController extends Controller{

    public function indexAction(Request $request){
        if($this->getUser()) return $this->redirectToRoute('apachecms_frontend_dashboard');
        return $this->render('ApachecmsFrontendBundle:Login:index.html.twig',array(
            'formLogin'=>$this->createForm(LoginType::class, null,array('action'=>$this->generateUrl('apachecms_api_login_submit'),'method' => 'POST'))->createView(),
            'formRegister'=>$this->createForm(CustomerType::class,new Customer(),array('method' => 'POST','action'=>$this->generateUrl('apachecms_api_login_create_submit')))->createView(),
            'formRegisterFacebook'=>$this->createForm(LoginByFacebookType::class,null,array('method' => 'POST','action'=>$this->generateUrl('apachecms_api_login_byFacebook_submit')))->createView(),
            'formRegisterGoogle'=>$this->createForm(LoginByGoogleType::class,null,array('method' => 'POST','action'=>$this->generateUrl('apachecms_api_login_byGoogle_submit')))->createView(),
            'formRecovery'=>$this->createForm(ForgotType::class,null,array('method' => 'POST','action'=>$this->generateUrl('apachecms_api_login_recovery_submit')))->createView()
        ));
    }
   
    public function resetAction($id,$code,Request $request,UserPasswordEncoderInterface $passwordEncoder){
        if($this->getUser()) return $this->redirectToRoute('apachecms_frontend_homepage');
        if(!$entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array('id'=>$id,'codeActive'=>$code))){
            $this->addFlash("danger", $this->get('translator')->trans('reset.link.expired'));
            return $this->redirectToRoute('security_login_frontend');
        }
        return $this->render('ApachecmsFrontendBundle:Login:reset.html.twig', array(
            'form'=>$this->createForm(RecoverType::class, null,array('action'=>$this->generateUrl('security_reset_password_frontend_submit',array('id'=>$id,'code'=>$code)),'method' => 'POST'))->createView(),
            'entity'=>$entity
        ));
    }
    
    public function selectPlanAction($id,Request $request){
        return $this->render('ApachecmsFrontendBundle:Login:plan.html.twig', array(
            'plans'=>$entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Plan')->findAll(),
            'entity'=>$entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->find($id)
        ));
    }
    
    public function profileAction(Request $request){
        return $this->render('ApachecmsFrontendBundle:Login:profile.html.twig', array(
            'entity'=>$entity=$this->get('security.token_storage')->getToken()->getUser(),
            'form'=>$this->createForm(CustomerExtraType::class, $entity,array('action'=>$this->generateUrl('security_api_profile_submit'),'method' => 'POST'))->createView(),
        ));
    }
    
    public function usernameAction(Request $request){
        return $this->render('ApachecmsFrontendBundle:Login:username.html.twig', array(
            'entity'=>$entity=$this->get('security.token_storage')->getToken()->getUser(),
            'form'=>$this->createForm(UsernameType::class, $entity,array('action'=>$this->generateUrl('security_api_username_submit'),'method' => 'POST'))->createView(),
        ));
    }

    public function logoutAction(){}
}
