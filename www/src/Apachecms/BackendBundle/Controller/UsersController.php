<?php

namespace Apachecms\BackendBundle\Controller;

use Apachecms\BackendBundle\Entity\User;
use Apachecms\BackendBundle\Form\User\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;

class UsersController extends BaseController{

	protected $pathBase="apachecms_backend_users";

	public function indexAction(){
		return $this->render('ApachecmsBackendBundle:Users:index.html.twig',array(
            'pathBase'=>$this->pathBase,
            'formDelete'=>$this->createDeleteFromAjaxForm($this->pathBase.'_delete')->createView(),
        ));
	}

	public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
			array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:User')->listAll()->getQuery()->getResult()), 'json'
		));
	}

	public function addAction(){
		return $this->render('ApachecmsBackendBundle:Users:form.html.twig',array(
			'form' => $this->generateForm(UserType::class,new User(),$this->pathBase)->createView(),
			'pathBase'=>$this->pathBase
        ));
	}

	public function createAction(Request $request,UserPasswordEncoderInterface $passwordEncoder) {
        $entity=new User();
        $form = $this->generateForm(UserType::class,$entity,$this->pathBase);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if($form->isValid()){
                $plainPassword = $form->get('plainPassword')->getData();
                $passwordConstraint = new Assert\NotBlank();
                $errorList=$this->get('validator')->validate($plainPassword,$passwordConstraint);
                if(count($errorList) == 0){
                    $password = $passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
                    $entity->setPassword($password);

                    /* UPLOAD FILE */
                    $entity->setPicture($this->uploadPicture($entity->getPicture()));

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($entity);
                    $em->flush();
                    $this->addFlash("success", $this->container->getParameter('messages')['result']['add']['text']);
                    return $this->redirectToRoute($this->pathBase);
                }else{
                    $errorMessage=new FormError($errorList[0]->getMessage());
                    $form->get('plainPassword')->get('first')->addError($errorMessage);
                    $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
                }
            }else{
                $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
            }
        }            
        return $this->render('ApachecmsBackendBundle:Users:form.html.twig', array('form' => $form->createView(),'pathBase'=>$this->pathBase));
    }	

	public function editAction($id){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:User')->find($id);
		return $this->render('ApachecmsBackendBundle:Users:form.html.twig',array(
            'form' => $this->generateForm(UserType::class,$entity,$this->pathBase)->createView(),
            'entity'=>$entity,
			'pathBase'=>$this->pathBase
        ));
	}

	public function updateAction(Request $request,$id,UserPasswordEncoderInterface $passwordEncoder) {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:User')->find($id);
        $entityPicture=$entity->getPicture();
        $form = $this->generateForm(UserType::class,$entity,$this->pathBase);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
			if($form->isValid()){
                /* UPLOAD FILE */
                $entity->setPicture($this->uploadPicture($entity->getPicture(),$entityPicture));
                if(!empty($form->get('plainPassword')->getData())){
					$password = $passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
					$entity->setPassword($password);
				}
                $em=$this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash('success', $this->container->getParameter('messages')['result']['edit']['text']);
                return $this->redirectToRoute($this->pathBase);
            }else{
                $entity->setPicture($entityPicture);
                $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
            }
        }            
        return $this->render('ApachecmsBackendBundle:Users:form.html.twig', array('form' => $form->createView(),'entity'=>$entity,'pathBase'=>$this->pathBase));
    }

    public function deleteAction($id, Request $request) {
        $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:User')->find($id);
        $form = $this->createDeleteFromAjaxForm($this->pathBase.'_delete');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entity->setIsDelete(true);
            $this->getDoctrine()->getManager()->flush();
            return new Response(
                json_encode(array('response' => true)), 200, array('Content-Type' => 'application/json')
            );
        }
        return new Response(json_encode(array('response' => false)), 200, array('Content-Type' => 'application/json'));
    }
}
