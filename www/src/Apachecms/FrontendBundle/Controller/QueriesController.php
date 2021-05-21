<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\BackendBundle\Form\Queries\ReplyType;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\LandingReply;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
class QueriesController extends Controller
{
    public function __construct(TokenStorage $storage = null,RouterInterface $router){
        if($storage->getToken()->getUser()->getUrlDestination()){
            $urlDestination=json_decode($storage->getToken()->getUser()->getUrlDestination(),true);
            header('Location: '.$router->generate($urlDestination['url'],$urlDestination['params']));
            exit();
        }
    }

    public function indexAction($id,Request $request){
        return $this->render('ApachecmsFrontendBundle:Queries:index.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id)
        ));
    }
    
    public function chatsAction($id,Request $request){
        return $this->render('ApachecmsFrontendBundle:Queries:chats.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id)
        ));
    }
    public function viewAction($id,$queryId,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingQuery')->find($queryId);
        if(!$entity->getIsRead()){
            $em=$this->getDoctrine()->getManager();
            $entity->setIsRead(true);
            $em->persist($entity);
            $em->flush();
        }
        return $this->render('ApachecmsFrontendBundle:Queries:view.html.twig',array(
            'query'=>$entity,
            'form'=>$this->createForm(ReplyType::class,new LandingReply(),array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_queries_reply',array('queryId'=>$queryId))
                ))->createView()
        ));
    }
    public function chatViewAction($id,$queryId,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->find($queryId);
        
        return $this->render('ApachecmsFrontendBundle:Queries:chatView.html.twig',array(
            'query'=>$entity,
            'statMessages'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:StatMessage')->findByStat($entity)
        ));
    }
    public function contactsAction($id,Request $request){
        return $this->render('ApachecmsFrontendBundle:Queries:contacts.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id)
        ));
    }
}
