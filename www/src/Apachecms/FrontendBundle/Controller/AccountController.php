<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Apachecms\BackendBundle\Form\Customer\CustomerEditType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Apachecms\BackendBundle\Form\Customer\CustomerExtraType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class AccountController extends Controller
{
    public function __construct(TokenStorage $storage = null,RouterInterface $router){
        if($storage->getToken()->getUser()->getUrlDestination() && !$storage->getToken()->getUser()->getProfileIsComplete()){
            $urlDestination=json_decode($storage->getToken()->getUser()->getUrlDestination(),true);
            header('Location: '.$router->generate($urlDestination['url'],$urlDestination['params']));
            exit();
        }elseif($storage->getToken()->getUser()->getIsLocked()){
            header('Location: '.$router->generate('apachecms_frontend_lock'));
            exit();
        }
    }

    public function indexAction()
    {
        return $this->render('ApachecmsFrontendBundle:Account:index.html.twig');
    }
    
    public function contactsAction()
    {
        return $this->render('ApachecmsFrontendBundle:Account:contacts.html.twig');
    }
    
    public function planAction()
    {
        return $this->render('ApachecmsFrontendBundle:Account:plan.html.twig');
    }
    
    public function planRenewAction()
    {
        return $this->render('ApachecmsFrontendBundle:Account:planRenew.html.twig',array(
            'plans'=>$entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Plan')->findAll()
        ));
    }
    
    public function picturesAction()
    {
        return $this->render('ApachecmsFrontendBundle:Account:pictures.html.twig');
    }

    public function profileAction()
    {
        $form=$this->createForm(CustomerExtraType::class,$this->get('security.token_storage')->getToken()->getUser(),array(
            'method' => 'POST',
            'action'=>$this->generateUrl('apachecms_api_account_submit')))
            ->add('email',EmailType::class,array('label'=>'form.email','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control')));
        return $this->render('ApachecmsFrontendBundle:Account:profile.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    public function profileSaveAction(Request $request,UserPasswordEncoderInterface $passwordEncoder) {
        $entity=$this->get('security.token_storage')->getToken()->getUser();
        $entityPicture=$entity->getPicture();
        $form = $this->createForm(CustomerEditType::class,$entity,array('method' => 'POST','action'=>$this->generateUrl('apachecms_frontend_account_save')));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
			if($form->isValid()){
                if(!empty($form->get('plainPassword')->getData())){
					$password = $passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
					$entity->setPassword($password);
				}
                $em=$this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash('success', $this->container->getParameter('messages')['result']['edit']['text']);
                return $this->redirectToRoute('apachecms_frontend_account');
            }else{
                $entity->setPicture($entityPicture);
                $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
            }
        }            
        return $this->render('ApachecmsFrontendBundle:Account:profile.html.twig', array('form'=>$form->createView()));
    }
}
