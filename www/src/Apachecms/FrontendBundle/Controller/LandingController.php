<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\BackendBundle\Form\Landing\Step1Type;
use Apachecms\BackendBundle\Form\Landing\Step2Type;
use Apachecms\BackendBundle\Form\Landing\Step3Type;
use Apachecms\BackendBundle\Form\Landing\Step4Type;
use Apachecms\BackendBundle\Form\Landing\Step5Type;
use Apachecms\BackendBundle\Form\LandingPluginType;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\Landing;
use Apachecms\FrontendBundle\Form\Landing\ContactType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
class LandingController extends Controller
{
    public function __construct(TokenStorage $storage = null,RouterInterface $router){
        if($storage->getToken()->getUser()->getUrlDestination()){
            $urlDestination=json_decode($storage->getToken()->getUser()->getUrlDestination(),true);
            header('Location: '.$router->generate($urlDestination['url'],$urlDestination['params']));
            exit();
        }
    }

    public function indexAction()
    {
        return $this->render('ApachecmsFrontendBundle:Landing:index.html.twig');
    }
    
    public function step1Action($id=null)
    {
        
        if($this->get('security.token_storage')->getToken()->getuser()->getPlan()->getMaxLanding() <= count($this->get('security.token_storage')->getToken()->getUser()->getLandings())){
            $this->addFlash("danger", $this->get('translator')->trans('max.landings'));
            return $this->redirectToRoute('apachecms_frontend_dashboard');
        }
        $entity=($id)?$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id):new Landing();
        return $this->render('ApachecmsFrontendBundle:Landing:step1.html.twig',array(
            'entity'=>$entity,
            'form'=>$this->createForm(Step1Type::class,$entity,array(
                'user'=>$this->get('security.token_storage')->getToken()->getUser(),
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step1_submit',array('id'=>$id))
                ))->createView()
        ));
    }

    public function step2Action($id)
    {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:step2.html.twig',array(
            'entity'=>$entity,
            'form'=>$this->createForm(Step2Type::class,$entity,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step2_submit',array('id'=>$id))
                ))->createView()
        ));
    }
    
    public function step3Action($id)
    {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:step3.html.twig',array(
            'entity'=>$entity,
            'form'=>$this->createForm(Step3Type::class,$entity,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step3_submit',array('id'=>$id))
                ))->createView()
        ));
    }
    
    public function step4Action($id)
    {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:step4.html.twig',array(
            'entity'=>$entity,
            'filesIndustry'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:File')->findRandByIndustry($entity->getIndustry(),12)->getQuery()->getResult(),
            'form'=>$this->createForm(Step4Type::class,$entity,array(
                'method' => 'POST',
                'action'=>$this->generateUrl('apachecms_api_landing_step4_submit',array('id'=>$id))
                ))->createView()
        ));
    }
    
    public function step5Action($id)
    {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:step5.html.twig',array(
            'entity'=>$entity,
            'filesIndustry'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:File')->findRandByIndustry($entity->getBusiness()->getIndustry(),12)->getQuery()->getResult(),
            'form'=>$this->createForm(Step5Type::class,$entity,array(
                'method' => 'POST',
                'action'=>$this->generateUrl('apachecms_api_landing_step5_submit',array('id'=>$id))
                ))->createView()
        ));
    }
    
    public function previewAction($id,$template,Request $request)
    {
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        $testCase=array('testId'=>null,'option'=>0);
        if($entity->getIsActiveAI() && $entity->getIsPublished()){
            $test=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingTest')->getActive($entity)->getQuery()->getOneOrNullResult();
            $testCase=array('testId'=>$test->getId(),'option'=>rand(1,4));
        }
        return $this->render('ApachecmsFrontendBundle:Templates:'.$template.'.html.twig',array(
            'entity'=>$entity,
            'prod'=>false,
            'testCase'=>$testCase,
            'formContact'=>$this->createForm(ContactType::class,null,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_contact_submit',array('id'=>$entity->getId()),true)))->createView(),
            'template'=>$template
        ));
    }
    
    public function viewAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        $tests=null;
        if($entity->getIsActiveAI()){
            $tests=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingTest')->getActive($entity)->getQuery()->getResult();
        }

        return $this->render('ApachecmsFrontendBundle:Landing:view.html.twig',array(
            'entity'=>$entity,
            'tests'=>$tests,
            'formDelete'=>$this->createFormBuilder()
            ->setAction($this->generateUrl('apachecms_api_landing_delete_submit', array('id' => ':ENTITY_ID')))
            ->setMethod('DELETE')
            ->getForm()->createView(),
        ));
    }
    
    public function edit4Action($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:edit/step4.html.twig',array(
            'entity'=>$entity,
            'form'=>$this->createForm(Step4Type::class,$entity,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step4_submit',array('id'=>$id))
                ))->createView()
        ));
    }
    
    public function edit3Action($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:edit/step3.html.twig',array(
            'entity'=>$entity,
            'form'=>$this->createForm(Step3Type::class,$entity,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step3_submit',array('id'=>$id))
                ))->createView()
        ));
    }
    
    public function edit2Action($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:edit/step2.html.twig',array(
            'form'=>$this->createForm(Step2Type::class,$entity,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step2_submit',array('id'=>$id))
                ))->createView(),
            'entity'=>$entity
        ));
    }
    
    public function edit1Action($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Landing:edit/step1.html.twig',array(
            'form'=>$this->createForm(Step1Type::class,$entity,array(
                'user'=>$this->get('security.token_storage')->getToken()->getUser(),
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_step1_submit',array('id'=>$id))
                ))->createView(),
            'entity'=>$entity
        ));
    }
    
    public function pluginsAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        $plugins=($entity->getPlugins())?$entity->getPlugins():null;
        return $this->render('ApachecmsFrontendBundle:Landing:edit/plugins.html.twig',array(
            'form'=>$this->createForm(LandingPluginType::class,$plugins,array(
                'method' => 'POST', 
                'action'=>$this->generateUrl('apachecms_api_landing_plugins_submit',array('id'=>$id))
                ))->createView(),
            'entity'=>$entity
        ));
    }
    
}
