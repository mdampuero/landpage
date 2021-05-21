<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\FrontendBundle\Form\Landing\ContactType;
use Apachecms\FrontendBundle\Form\Pay\PayType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Apachecms\BackendBundle\Entity\CustomerTransaction;

class DefaultController extends Controller
{
    public function indexAction(){
        header('Location: https://www.land.page');
        exit();
        return $this->render('ApachecmsFrontendBundle:Default:index_tmp.html.twig');
    }
    
    public function errorAction(){
        return $this->render('ApachecmsFrontendBundle:Default:error.html.twig');
    }
    
    public function validateAction($id,$code,Request $request){
        $em=$this->getDoctrine()->getManager();
        if(!$entity = $em->getRepository('ApachecmsBackendBundle:Customer')->findOneBy(array('id'=>$id,'codeActive'=>$code)))
            throw new Exception(null,200);
        $entity->setIsValidate(true);
        if($entity->getLockedType()=='not_validate'){
            $entity->setIsLocked(false);
            $entity->setLockedType(null);
            $entity->setLockedDescription(null);
        }
        $em->persist($entity);
        $em->flush();
        $this->addFlash('success', $this->get('translator')->trans('validate.email.finish'));
        return $this->redirectToRoute('apachecms_frontend_dashboard');
    }
    
    public function simPayAction($plan,$customer,Request $request){
        $em=$this->getDoctrine()->getManager();
        $plan=$em->getRepository('ApachecmsBackendBundle:Plan')->find($plan);
        $customer=$em->getRepository('ApachecmsBackendBundle:Customer')->find($customer);

        $trial=false;
        // $em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->deleteAll($customer->getId());
        $transaction = new CustomerTransaction($plan,$trial,$customer);
        $transaction->setStatus('initial');
        $transaction->setStatusDescription('initial');
        $em->persist($transaction);
        $em->flush();
        return $this->render('ApachecmsFrontendBundle:Default:simPay.html.twig',array(
            'plan'=>$plan,
            'form'=>$this->createForm(PayType::class,$transaction,array('action'=>$this->generateUrl('apachecms_api_pay_submit',array(
                'plan'=>$plan->getId(),
                'transaction'=>$transaction->getId(),
                ))))->createView(),
            'transaction'=>$transaction,
        ));
    }
    
    public function simPayMPAction($plan,$customer,Request $request){
        $em=$this->getDoctrine()->getManager();
        $plan=$em->getRepository('ApachecmsBackendBundle:Plan')->find($plan);
        $customer=$em->getRepository('ApachecmsBackendBundle:Customer')->find($customer);

        $trial=false;
        // $em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->deleteAll($customer->getId());
        $transaction = new CustomerTransaction($plan,$trial,$customer);
        $transaction->setStatus('initial');
        $transaction->setStatusDescription('initial');
        $em->persist($transaction);
        $em->flush();
        return $this->render('ApachecmsFrontendBundle:Default:simPayMP.html.twig',array(
            'plan'=>$plan,
            'form'=>$this->createForm(PayType::class,$transaction,array('action'=>$this->generateUrl('apachecms_api_pay_submit',array(
                'plan'=>$plan->getId(),
                'transaction'=>$transaction->getId(),
                ))))->createView(),
            'transaction'=>$transaction,
        ));
    }
    
    public function landAction($slug,Request $request)
    {
        $usernameUrl=str_replace('/','',current(explode('/'.$slug,$request->getPathInfo())));
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->findOneBySlug($slug,$usernameUrl)->getQuery()->getOneOrNullResult();
        if(!$entity || (!$entity->getIsPublished() && $entity->getCustomer()!=$this->get('security.token_storage')->getToken()->getUser()))
            throw new NotFoundHttpException($this->get('translator')->trans('landing_not_found'));
        if($entity->getCustomer()->getIsLocked())
            throw new NotFoundHttpException($this->get('translator')->trans('landing_not_found'));
        $testCase=array('testId'=>null,'option'=>0);
        if($entity->getIsActiveAI()){
            $test=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingTest')->getActive($entity)->getQuery()->getOneOrNullResult();
            if($test){
                $testCase=array('testId'=>$test->getId(),'option'=>rand(1,4));
            }else{
                $testCase=array('testId'=>null,'option'=>0);
            }
        }
        return $this->render('ApachecmsFrontendBundle:Templates:'.$entity->getTemplate().'.html.twig',array(
            'entity'=>$entity,
            'prod'=>true,
            'testCase'=>$testCase,
            'template'=>$entity->getTemplate(),
            'formContact'=>$this->createForm(ContactType::class,null,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_contact_submit',array('id'=>$entity->getId()),UrlGeneratorInterface::ABSOLUTE_URL)))->createView(),
            'referer'=>(key_exists('HTTP_REFERER',$_SERVER))?$_SERVER['HTTP_REFERER']:'vacio'
        ));
    }
    
    public function successAction($idLanding,$idQuery,Request $request)
    {
        $landing=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($idLanding);
        $query=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingQuery')->find($idQuery);
        if(!$landing || !$query)
            throw new NotFoundHttpException($this->get('translator')->trans('landing_not_found'));
        return $this->render('ApachecmsFrontendBundle:Templates:success.html.twig',array(
            'entity'=>$landing,
            'query'=>$query,
            'prod'=>true,
            'template'=>$landing->getTemplate(),
        ));
    }
    
    
    public function changeLocaleAction(request $request){
        return $this->redirect($request->headers->get('referer'));
    }
    
    public function hardAction(request $request){
        $customer=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Customer')->findAll();
        foreach ($customer as $key => $c) {
            $output = shell_exec($this->get('kernel')->getRootDir().DIRECTORY_SEPARATOR.'script.sh '.$c->getUsernameUrl().' '.$this->get('kernel')->getRootDir().'/../src/Apachecms/FrontendBundle/Resources/config/dinamic.yml');
        }
        dump($customer);
        exit();
    }
}
