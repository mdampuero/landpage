<?php

namespace Apachecms\BackendBundle\Controller;

use Apachecms\BackendBundle\Entity\Site;
use Apachecms\BackendBundle\Form\Site\SiteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SitesController extends BaseController{

	protected $pathBase="apachecms_backend_sites";

	public function indexAction(){
		return $this->render('ApachecmsBackendBundle:Sites:index.html.twig',array(
            'pathBase'=>$this->pathBase,
            'formDelete'=>$this->createDeleteFromAjaxForm($this->pathBase.'_delete')->createView(),
        ));
	}

	public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
			array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Site')->listAll()->getQuery()->getResult()), 'json'
		));
	}

	public function addAction(){
		return $this->render('ApachecmsBackendBundle:Sites:form.html.twig',array(
			'form' => $this->generateForm(SiteType::class,new Site(),$this->pathBase)->createView(),
			'pathBase'=>$this->pathBase
        ));
	}

	public function createAction(Request $request) {
        $entity=new Site();
        $form = $this->generateForm(SiteType::class,$entity,$this->pathBase);
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
        return $this->render('ApachecmsBackendBundle:Sites:form.html.twig', array('form' => $form->createView(),'pathBase'=>$this->pathBase));
    }	

	public function editAction($id){
		return $this->render('ApachecmsBackendBundle:Sites:form.html.twig',array(
            'form' => $this->generateForm(SiteType::class,$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Site')->find($id),$this->pathBase)->createView(),
			'pathBase'=>$this->pathBase
        ));
	}

	public function updateAction(Request $request,$id) {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Site')->find($id);
        $form = $this->generateForm(SiteType::class,$entity,$this->pathBase);
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
        return $this->render('ApachecmsBackendBundle:Sites:form.html.twig', array('form' => $form->createView(),'entity'=>$entity,'pathBase'=>$this->pathBase));
    }

    public function deleteAction($id, Request $request) {
        $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Site')->find($id);
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
