<?php

namespace Apachecms\BackendBundle\Controller;

use Apachecms\BackendBundle\Entity\Setting;
use Apachecms\BackendBundle\Form\Setting\SettingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends BaseController{

    protected $pathBase="apachecms_backend_settings";

	public function editAction(){
		return $this->render('ApachecmsBackendBundle:Settings:form.html.twig',array(
            'form' => $this->generateForm(SettingType::class,$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Setting')->find('setting'),$this->pathBase)->createView()
        ));
	}

	public function updateAction(Request $request,$id) {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Setting')->find($id);
        $form = $this->generateForm(SettingType::class,$entity,$this->pathBase);
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
        return $this->render('ApachecmsBackendBundle:Setting:form.html.twig', array('form' => $form->createView(),'entity'=>$entity,'pathBase'=>$this->pathBase));
    }

}
