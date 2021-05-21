<?php

namespace Apachecms\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class NotificationsController extends BaseController{

    public function getAllAction(){
        $entities=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Notification')
        ->getAll()
        ->andWhere('e.customer =:customer')->setParameter('customer',$this->get('security.token_storage')->getToken()->getUser()->getId())
        ->addOrderBy("e.isRead","ASC")
        ->getQuery()
        ->getResult();
        return $this->responseOk($entities);
    }
    
    public function makeReadAction($id){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Notification')->find($id);
        $em=$this->getDoctrine()->getManager();
        $entity->setIsRead(true);
        $em->persist($entity);
        $em->flush();
        
        return $this->responseOk($entity);
    }
    
}
