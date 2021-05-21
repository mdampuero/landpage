<?php

namespace Apachecms\BackendBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaysController extends BaseController{

	protected $pathBase="apachecms_backend_pays";

	public function indexAction(){
		return $this->render('ApachecmsBackendBundle:Pays:index.html.twig',array(
            'pathBase'=>$this->pathBase,
            'formDelete'=>$this->createDeleteFromAjaxForm($this->pathBase.'_delete')->createView(),
        ));
	}

	public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
			array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:CustomerTransaction')->listAll()->getQuery()->getResult()), 'json'
		));
	}

    public function deleteAction($id, Request $request) {
        $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:CustomerTransaction')->find($id);
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
