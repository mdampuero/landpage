<?php

namespace Apachecms\BackendBundle\Controller;

use Apachecms\BackendBundle\Entity\Demo;
use Apachecms\BackendBundle\Form\Demo\DemoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DemosController extends BaseController{

	protected $pathBase="apachecms_backend_demos";

	public function indexAction(){
		return $this->render('ApachecmsBackendBundle:Demos:index.html.twig',array(
            'pathBase'=>$this->pathBase,
            'formDelete'=>$this->createDeleteFromAjaxForm($this->pathBase.'_delete')->createView(),
        ));
	}

	public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
			array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Demo')->listAll()->getQuery()->getResult()), 'json'
		));
	}

	public function addAction(){
		return $this->render('ApachecmsBackendBundle:Demos:form.html.twig',array(
			'form' => $this->generateForm(DemoType::class,new Demo(),$this->pathBase)->createView(),
			'pathBase'=>$this->pathBase
        ));
	}

	public function createAction(Request $request) {
        $entity=new Demo();
        $form = $this->generateForm(DemoType::class,$entity,$this->pathBase);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if($form->isValid()){
                $em=$this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash('success', $this->container->getParameter('messages')['result']['add']['text']);
                return $this->redirectToRoute($this->pathBase);
            }else{
                $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
            }
        }            
        return $this->render('ApachecmsBackendBundle:Demos:form.html.twig', array('form' => $form->createView(),'pathBase'=>$this->pathBase));
    }	

	public function editAction($id){
		return $this->render('ApachecmsBackendBundle:Demos:form.html.twig',array(
            'form' => $this->generateForm(DemoType::class,$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Demo')->find($id),$this->pathBase)->createView(),
			'pathBase'=>$this->pathBase
        ));
	}

	public function updateAction(Request $request,$id) {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Demo')->find($id);
        $form = $this->generateForm(DemoType::class,$entity,$this->pathBase);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
			if($form->isValid()){
                $em=$this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $this->addFlash('success', $this->container->getParameter('messages')['result']['edit']['text']);
                return $this->redirectToRoute($this->pathBase);
            }else{
                $this->addFlash("danger", $this->container->getParameter('messages')['result']['error']['text']);
            }
        }            
        return $this->render('ApachecmsBackendBundle:Demos:form.html.twig', array('form' => $form->createView(),'entity'=>$entity,'pathBase'=>$this->pathBase));
    }

    public function deleteAction($id, Request $request) {
        $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Demo')->find($id);
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
