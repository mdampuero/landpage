<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Form\Queries\ReplyType;
use Apachecms\BackendBundle\Entity\LandingReply;


class QueriesController extends BaseController{

    public function getAllAction($landing){
        return $this->responseOk($this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingQuery')->findByLanding($landing, array('createdAt' => 'DESC')));
    }
    
    public function getContactsAction($landing){
        return $this->responseOk($this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingContact')->findByLanding($landing));
    }
    
    public function getChatsAction($landing){
        return $this->responseOk($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->findBy(array(
            'landingId'=>$landing,
            'validLead'=>true
        )));
    }
    
    public function replyAction($queryId,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();

            $query=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingQuery')->find($queryId);
            $entity=new LandingReply();
            $form=$this->createForm(ReplyType::class,$entity);
            $form->handleRequest($request);
            if($errors=$this->ifErrors($form)) return $errors;
            
            if(!$query->getIsReply()){
                $query->setIsReply(true);
                $em->persist($query);
            }

            $entity->setQuery($query);
            
            $em->persist($entity);
            $em->flush();

            $message = (new \Swift_Message($this->getParameter('title')))
            ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            ->setTo($query->getContact()->getEmail())
            ->setReplyTo($query->getLanding()->getCustomer()->getEmail())
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/reply.html.twig', array('query' => $query,'reply' => $entity)),'text/html');
            $this->get('mailer')->send($message);

            $this->addFlash("success",$this->get('translator')->trans('reply.sending'));
            return $this->responseOk('OK');
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
}
