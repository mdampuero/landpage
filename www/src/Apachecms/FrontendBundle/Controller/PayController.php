<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\FrontendBundle\Form\Landing\ContactType;
use Apachecms\FrontendBundle\Form\Pay\PayType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Apachecms\BackendBundle\Entity\CustomerTransaction;

class PayController extends Controller{

    public function indexAction($plan,$back=null,$type=null,Request $request){
        $em=$this->getDoctrine()->getManager();
        $plan=$em->getRepository('ApachecmsBackendBundle:Plan')->find($plan);
        $customer=$this->get('security.token_storage')->getToken()->getUser();
        $trial=false;
        // $em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->deleteAll($customer->getId());
        $transaction = new CustomerTransaction($plan,$trial,$customer,$type);
        $transaction->setStatus('initial');
        $transaction->setStatusDescription('initial');
        $em->persist($transaction);
        $em->flush();
        
        return $this->render('ApachecmsFrontendBundle:Pay:index.html.twig',array(
            'plan'=>$plan,
            'form'=>$this->createForm(PayType::class,$transaction,array('action'=>$this->generateUrl('apachecms_api_pay_submit',array(
                'plan'=>$plan->getId(),
                'back'=>$back,
                'transaction'=>$transaction->getId(),
                ))))->createView(),
            'transaction'=>$transaction,
        ));
    }
    public function indexMPAction($plan,$back=null,$type=null,Request $request){
        $em=$this->getDoctrine()->getManager();
        $plan=$em->getRepository('ApachecmsBackendBundle:Plan')->find($plan);
        $customer=$this->get('security.token_storage')->getToken()->getUser();
        $trial=false;
        // $em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->deleteAll($customer->getId());
        $transaction = new CustomerTransaction($plan,$trial,$customer,$type);
        $transaction->setStatus('initial');
        $transaction->setStatusDescription('initial');
        $em->persist($transaction);
        $em->flush();
        
        return $this->render('ApachecmsFrontendBundle:Pay:indexMP.html.twig',array(
            'plan'=>$plan,
            'form'=>$this->createForm(PayType::class,$transaction,array('action'=>$this->generateUrl('apachecms_api_pay_submit',array(
                'plan'=>$plan->getId(),
                'back'=>$back,
                'transaction'=>$transaction->getId(),
                ))))->createView(),
            'transaction'=>$transaction,
        ));
    }
   
}
