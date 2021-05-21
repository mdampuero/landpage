<?php

namespace Apachecms\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Form\FormError;
use Apachecms\BackendBundle\Form\Login\LoginType;
use Apachecms\BackendBundle\Form\Login\ForgotType;
use Apachecms\BackendBundle\Form\Login\RecoverType;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller{

    public function indexAction(Request $request, AuthenticationUtils $authUtils){
        if($this->getUser()) return $this->redirectToRoute('apachecms_backend_homepage');

        if($authUtils->getLastAuthenticationError()) $this->addFlash("danger", 'Email y contraseña incorrecto');
        return $this->render('ApachecmsBackendBundle:Login:index.html.twig',array(
            'form'=>$this->createForm(LoginType::class, null,array('method' => 'POST'))->createView(),
            'formForgot'=>$this->createForm(ForgotType::class, null,array('method' => 'POST','action' => $this->generateUrl('security_forgot')))->createView()
        ));
    }

    public function forgotAction(Request $request){
        $form = $this->createForm(ForgotType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()){  
                $email=$form->get('email')->getData();
                $em=$this->getDoctrine()->getManager();
                $entity = $em->getRepository('ApachecmsBackendBundle:User')->findOneBy(array('email'=>$email,'isDelete'=>false));
                if($entity){
                    $entity->setCodeActive(md5(md5(uniqid().uniqid())));
                    $em->persist($entity);
                    $em->flush();
                    $message = (new \Swift_Message($this->getParameter('title').' - Restablecimiento de contraseña'))
                    ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
                    ->setTo($entity->getEmail())
                    ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Login/forgotPassword.html.twig', array('entity' => $entity)),'text/html');
                    $this->get('mailer')->send($message); 
                    return new Response(json_encode(array('response' => true,'message'=>'Te enviamos las indicaciones para recuperar la contraseña.')), 200, array('Content-Type' => 'application/json'));
                }else{
                    return new Response(json_encode(array('response' => false,'message'=>'EL correo no pertenece a ninguna cuenta activa')), 200, array('Content-Type' => 'application/json'));
                }
            }
        }
        return new Response(json_encode(array('response' => false,'message'=>'Algo falló')), 200, array('Content-Type' => 'application/json'));
    }

    public function resetAction($id,$code,Request $request,UserPasswordEncoderInterface $passwordEncoder){
        if($this->getUser()) return $this->redirectToRoute('apachecms_backend_homepage');
        $form = $this->createForm(RecoverType::class);
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        if($entity = $em->getRepository('ApachecmsBackendBundle:User')->findOneBy(array('id'=>$id,'codeActive'=>$code))){
            if ($form->isSubmitted()) {
                if($form->isValid()){
                    $password = $passwordEncoder->encodePassword($entity, $form->get('plainPassword')->getData());
                    $entity->setPassword($password);
                    $entity->setCodeActive(md5(md5(uniqid().uniqid())));
                    $em->persist($entity);
                    $em->flush();
                    $this->addFlash("success", 'La contraseña se restableció correctamente, ya puedes ingresar.');
                    return $this->redirectToRoute('security_login');
                }else{
                    $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
                }
            }
        }else{
            $this->addFlash("danger", "Este link ya caducó.");
            return $this->redirectToRoute('security_login');
        }
        return $this->render('ApachecmsBackendBundle:Login:reset.html.twig', array(
            'form'=>$form->createView())
        );
    }

    public function logoutAction(){}
}
