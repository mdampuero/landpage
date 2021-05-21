<?php

namespace Apachecms\BackendBundle\Controller;

use Apachecms\BackendBundle\Entity\Customer;
use Apachecms\BackendBundle\Form\Customer\CustomerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;

class CustomersController extends BaseController{

	protected $pathBase="apachecms_backend_customers";

	public function indexAction(){
		return $this->render('ApachecmsBackendBundle:Customers:index.html.twig',array(
            'pathBase'=>$this->pathBase,
            'formDelete'=>$this->createDeleteFromAjaxForm($this->pathBase.'_delete')->createView(),
        ));
	}

	public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
			array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->listAll()->getQuery()->getResult()), 'json'
		));
	}
	
    public function extendAction(Request $request){
        $customerId=$request->get('customer');
        $customer=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->find($customerId);
        $days=(int)$request->get('days');
		$now=new \DateTime();
        if($customer->getExpirationPlan()<$now || $customer->getUseTrial()==true){
            $customer->setExpirationPlan($now->modify('+'.$days.' days'));
            $customer->setIsLocked(false);
        }else{
            $expiredAt=new \DateTime($customer->getExpirationPlan()->format('Y-m-d H:i:s'));
            $newExpiredAt=$expiredAt->modify('+'.$days.' days');
            $customer->setExpirationPlan($newExpiredAt);
        }
        
        $em=$this->getDoctrine()->getManager();
        $em->persist($customer);
        $em->flush();
        return $this->response->setContent($this->serializer->serialize(
			array('response'=>true), 'json'
		));
	}

    public function viewAction($id){
		return $this->render('ApachecmsBackendBundle:Customers:form.html.twig',array(
            'pathBase'=>$this->pathBase,
            'entity' => $landing=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->find($id)
        ));
    }
    
    public function approveAction($id){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->find($id);
        $em=$this->getDoctrine()->getManager();
        if($entity->getLockedType()=='not_validate'){
            $entity->setIsValidate(true);
        }
        $entity->setIsLocked(false);
        $entity->setLockedType(null);
        $entity->setLockedDescription(null);
        $em->persist($entity);
        $em->flush();
        /* BEGIN SEND NOTIFICATION */
        $notifications = $this->get('notifications')->send(array(
            'title'=>'Tu cuenta fue habilitada.',
            'description'=>'Hemos habilitado nuevamente tu cuenta, ya puedes ingresar.',
            'type'=>'customer_unlocked',
            'path'=>null,
            'typeId'=>null,
            'customer'=>$entity,
            'link'=>$this->generateUrl('apachecms_frontend_notifications')
        ));
        /* END SEND NOTIFICATION */
        $this->addFlash('success', 'Se habilitó el cliente');
		return $this->response->setContent($this->serializer->serialize(
			array('response'=>true), 'json'
		));
    }
    
    public function rejectAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->find($id);
        $em=$this->getDoctrine()->getManager();
        $entity->setIsLocked(true);
        $entity->setLockedType('other');
        $entity->setLockedDescription($request->get('reason_for_rejection'));
        /* BEGIN SEND NOTIFICATION */
        $notifications = $this->get('notifications')->send(array(
            'title'=>'Tu cuenta fue bloqueada.',
            'description'=>$request->get('reason_for_rejection'),
            'type'=>'customer_locked',
            'path'=>null,
            'typeId'=>null,
            'customer'=>$entity,
            'link'=>$this->generateUrl('apachecms_frontend_notifications')
        ));
        /* END SEND NOTIFICATION */
        $em->persist($entity);
        $em->flush();
        $this->addFlash('success', 'Se bloqueó el usuario');
		return $this->response->setContent($this->serializer->serialize(
			array('response'=>true), 'json'
		));
    }
    
    public function deleteAction($id, Request $request) {
        $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->find($id);
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
