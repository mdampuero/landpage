<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\BackendBundle\Form\Business\BusinessType;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\Business;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class BusinessController extends Controller
{
    public function __construct(TokenStorage $storage = null,RouterInterface $router){
        if($storage->getToken()->getUser()->getUrlDestination()){
            $urlDestination=json_decode($storage->getToken()->getUser()->getUrlDestination(),true);
            header('Location: '.$router->generate($urlDestination['url'],$urlDestination['params']));
            exit();
        }
    }

    public function indexAction(Request $request){
        return $this->render('ApachecmsFrontendBundle:Business:index.html.twig');
    }

    public function addAction($back=null)
    {
        if($this->get('security.token_storage')->getToken()->getuser()->getPlan()->getMaxBusiness() <= count($this->get('security.token_storage')->getToken()->getUser()->getBusiness())){
            $this->addFlash("danger", $this->get('translator')->trans('max.business'));
            return $this->redirectToRoute('apachecms_frontend_business');
        }
        return $this->render('ApachecmsFrontendBundle:Business:form.html.twig',array(
            'form'=>$this->createForm(BusinessType::class,new Business(),array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_business_add')
                ))->createView()
        ));
    }
    public function editAction($id)
    {
        return $this->render('ApachecmsFrontendBundle:Business:form.html.twig',array(
            'entity'=>$entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Business')->find($id),   
            'formDelete'=>$this->createFormBuilder()
            ->setAction($this->generateUrl('apachecms_api_business_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()->createView(),         
            'form'=>$this->createForm(BusinessType::class,$entity,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_business_edit',array('id'=>$id))
                ))->createView()
        ));
    }
    
}
