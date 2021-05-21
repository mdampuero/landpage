<?php

namespace Apachecms\BackendBundle\Controller;

use Apachecms\BackendBundle\Entity\Landing;
use Apachecms\BackendBundle\Form\Landing\LandingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\Notification;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;

class LandingsController extends BaseController{

	protected $pathBase="apachecms_backend_landings";

	public function indexAction(){
		return $this->render('ApachecmsBackendBundle:Landings:index.html.twig',array(
            'pathBase'=>$this->pathBase,
            'formDelete'=>$this->createDeleteFromAjaxForm($this->pathBase.'_delete')->createView(),
        ));
	}

	public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
			array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->listAll()->getQuery()->getResult()), 'json'
		));
	}
    
    public function approveAction($landing){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($landing);
        $em=$this->getDoctrine()->getManager();
        $entity->setIsReview(true);
        $em->persist($entity);
        $em->flush();
        $this->addFlash('success', 'Se aprobó la publicación de esta Landing');
		return $this->response->setContent($this->serializer->serialize(
			array('response'=>true), 'json'
		));
	}
    
    public function rejectAction($landing,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($landing);
        $em=$this->getDoctrine()->getManager();
        $entity->setIsReview(false);
        $entity->setReasonForRejection($request->get('reason_for_rejection'));
        $entity->setIsPublished(false);
        $entity->setPublishedFromAt(null);
        $entity->setPublishedToAt(null);
        $entity->setStatus('ready');
        /* BEGIN SEND NOTIFICATION */
        $notifications = $this->get('notifications')->send(array(
            'title'=>'Tu landing "'.$entity->getTitle().'" fue rechazada.',
            'description'=>$request->get('reason_for_rejection'),
            'type'=>'landing',
            'path'=>$this->generateUrl('apachecms_frontend_landing_view',array('id'=>$entity->getId())),
            'typeId'=>$entity->getId(),
            'customer'=>$entity->getCustomer(),
            'link'=>$this->generateUrl('apachecms_frontend_notifications')
        ));
        /* END SEND NOTIFICATION */

        $em->persist($entity);
        $em->flush();
        $this->addFlash('success', 'Se rechazó la publicación de esta Landing');
		return $this->response->setContent($this->serializer->serialize(
			array('response'=>true), 'json'
		));
	}
    
    public function loadChatsAction($id){
        return $this->render('ApachecmsBackendBundle:Landings:chats.html.twig',array(
            'chats'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:StatMessage')->findByStat($id)
        ));
	}

    public function viewAction($id){
		return $this->render('ApachecmsBackendBundle:Landings:form.html.twig',array(
            'pathBase'=>$this->pathBase,
            'entity' => $landing=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id),
            'contacts'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingContact')->findByLanding($landing),
            'queries'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingQuery')->findByLanding($landing, array('createdAt' => 'DESC')),
            'chats'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->findBy(array(
                'landingId'=>$landing,
                'validLead'=>true
            )),
        ));
    }
    
    public function deleteAction($id, Request $request) {
        $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
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
