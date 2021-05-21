<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Form\Business\BusinessType;
use Apachecms\BackendBundle\Entity\Business;

class BusinessController extends BaseController{

    public function getAllAction(){
        return $this->responseOk($this->get('security.token_storage')->getToken()->getUser()->getBusiness());
    }
    
    public function addAction(Request $request){
        try {
            $entity=new Business();
            $form=$this->createForm(BusinessType::class, $entity);
            $form->handleRequest($request);
            if ($errors=$this->ifErrors($form)) return $errors;
            if ($form->get('brand')->getData())
                $entity->setBrand($this->uploadPicture($entity->getBrand()));
            
            $em=$this->getDoctrine()->getManager();
            $entity->setCustomer($this->get('security.token_storage')->getToken()->getUser());
            $em->persist($entity);
            $em->flush();
            return $this->responseOk($entity);
        } catch (Exception $excepcion) {
            return $this->responseFail(null, 200);
        }
    }
    public function editAction($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Business')->find($id);
            $brandOld=($entity->getBrand())?$entity->getBrand():null;
            $form=$this->createForm(BusinessType::class, $entity);
            $form->handleRequest($request);
            if ($errors=$this->ifErrors($form)) return $errors;
            if ($form->get('brand')->getData()) {
                $entity->setBrand($this->uploadPicture($entity->getBrand()));
            }else{
                $entity->setBrand($brandOld);
            } 
            $em=$this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->responseOk('OK');
        } catch (Exception $excepcion) {
            return $this->responseFail(null, 200);
        }
    }
    public function deleteAction($id, Request $request) {
        try {
            $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Business')->find($id);
            $form = $this->createFormBuilder()
            ->setAction(null)
            ->setMethod('DELETE')
            ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $entity->setIsDelete(true);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', $this->container->getParameter('messages')['delete']['success']);
            }
            return $this->responseOk('OK');
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage(),200);
        }
    }
}
