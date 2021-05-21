<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Form\Landing\Step1Type;
use Apachecms\BackendBundle\Form\Landing\Step2Type;
use Apachecms\BackendBundle\Form\Landing\Step3Type;
use Apachecms\BackendBundle\Form\Landing\Step4Type;
use Apachecms\BackendBundle\Form\Landing\Step5Type;
use Apachecms\BackendBundle\Form\LandingLabelType;
use Apachecms\BackendBundle\Form\LandingSocialType;
use Apachecms\BackendBundle\Form\LandingPluginType;
use Apachecms\BackendBundle\Form\LandingChatbotType;
use Apachecms\BackendBundle\Entity\Landing;
use Apachecms\BackendBundle\Entity\LandingContact;
use Apachecms\BackendBundle\Entity\LandingQuery;
use Apachecms\BackendBundle\Entity\LandingTest;
use Apachecms\BackendBundle\Entity\LandingLabel;
use Apachecms\BackendBundle\Entity\LandingService;
use Apachecms\BackendBundle\Entity\LandingSocial;
use Apachecms\BackendBundle\Entity\LandingChatbot;
use Apachecms\BackendBundle\Entity\LandingPlugin;
use Apachecms\BackendBundle\Entity\Notification;
use Apachecms\FrontendBundle\Form\Landing\ContactType;

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class LandingController extends BaseController{

    public function getAllAction(){
        return $this->responseOk($this->get('security.token_storage')->getToken()->getUser()->getLandings());
    }
    
    protected function getPalette($picture=null,$max=5){
        try {
            if(!$picture)
                throw new Exception('No se encontró el registro',200);
            $palette = Palette::fromFilename($this->getParameter('uploads_directory')['path'].$picture);
            $extractor = new ColorExtractor($palette);
            $colors = $extractor->extract($max);
            foreach($colors as $color){
                $colorsHEX[]=Color::fromIntToHex($color);
            }
            return $colorsHEX;
        } catch (Exception $excepcion) {
            return array('#3B5B81');
        }
    }

    public function step1Action($id=null,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            if($id){
                $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            }else{
                if($this->get('security.token_storage')->getToken()->getuser()->getPlan()->getMaxLanding() <= count($this->get('security.token_storage')->getToken()->getUser()->getLandings()))
                    return $this->responseFail($this->get('translator')->trans('max.landings'),200);
                $entity=new Landing();
            }
            $entity=($id)?$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id):new Landing();
            $form=$this->createForm(Step1Type::class,$entity,array('user'=>$this->get('security.token_storage')->getToken()->getUser(),'method' => 'POST', 'action'=>$this->generateUrl('apachecms_api_landing_step1_submit',array('id'=>$id))));
            $form->handleRequest($request);
            if($errors=$this->ifErrors($form)) return $errors;

            if($entity->getIsActiveAi()){
                if(empty($entity->getDescription2())) return $this->responseFail(array(array('property'=>'description_2','message'=>'Este valor no debería estar vacío.','code'=>'c1051bb4-d103-4f74-8988-acbcafc7fdc3','data'=>null)),200); 
                if(empty($entity->getDescription3())) return $this->responseFail(array(array('property'=>'description_3','message'=>'Este valor no debería estar vacío.','code'=>'c1051bb4-d103-4f74-8988-acbcafc7fdc3','data'=>null)),200); 
                if(empty($entity->getDescription4())) return $this->responseFail(array(array('property'=>'description_4','message'=>'Este valor no debería estar vacío.','code'=>'c1051bb4-d103-4f74-8988-acbcafc7fdc3','data'=>null)),200); 
            }
            $colors=array('#3B5B81');
            /* SAVE */
            if (!$id) {
                $colors=$this->getPalette($entity->getBusiness()->getBrand(), 5);
                $entity->setColorsSuggested(json_encode($colors));
                $labels=new LandingLabel();
                $labels->setHeaderTitle($entity->getDescription1());
                $labels->setFormLegend('Nota: Los datos proporcionados son confidenciales y para uso exclusivo de '.$entity->getBusiness()->getName());
                $labels->setAboutTitle($entity->getBusiness()->getName());
                $labels->setAboutDescription($entity->getDescription());
                $labels->setProductOrServiceDescription($entity->getDescription());
                $em->persist($labels);
                $entity->setLabels($labels);

                $socials=new LandingSocial();
                $socials->setFacebook($entity->getBusiness()->getFacebook());
                $socials->setWeb($entity->getBusiness()->getWeb());
                $socials->setGooglePlus($entity->getBusiness()->getGooglePlus());
                $socials->setTwitter($entity->getBusiness()->getTwitter());
                $socials->setYoutube($entity->getBusiness()->getYoutube());
                $socials->setInstagram($entity->getBusiness()->getInstagram());
                $socials->setLinkedin($entity->getBusiness()->getLinkedin());
                $em->persist($socials);
                $entity->setSocials($socials);

                $chatbot=new LandingChatbot();
                $chatbot->setTitle('Chat con '.$entity->getBusiness()->getName());
                $chatbot->setColour($colors[0]);
                $em->persist($chatbot);
                $entity->setChatbot($chatbot);

                $entity->setColorPrimary($colors[0]);
                $background=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:File')->findRandByIndustry($entity->getBusiness()->getIndustry())->getQuery()->getOneOrNullResult();
                $entity->setBackgroundImage($request->getScheme() . '://' .$request->getHttpHost() .$request->getBasePath().'/uploads/or/'.$background->getName());
                $entity->setContactEmail($entity->getBusiness()->getEmail());
                $entity->setContactAddress($entity->getBusiness()->getAddress());
                $entity->setContactAddress($entity->getBusiness()->getAddress());
                $entity->setContactPhone($entity->getBusiness()->getPhone());
                $entity->setContactAddressLat($entity->getBusiness()->getAddressLat());
                $entity->setContactAddressLng($entity->getBusiness()->getAddressLng());
                $entity->setContactAddressZoom($entity->getBusiness()->getAddressZoom());
                $entity->setContactReplyEmail($entity->getBusiness()->getReplyEmail());

                $plugin=new LandingPlugin();
                $plugin->setMetaTagsDescription($entity->getDescription1());
                $em->persist($plugin);
                $entity->setPlugins($plugin);
            }else{
                $labels=$entity->getLabels();
                $labels->setAboutDescription($entity->getDescription());
                $em->persist($labels);
            }

            $entity->setCustomer($this->get('security.token_storage')->getToken()->getUser());
            
            $em->persist($entity);
            $em->flush();

            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_landing_add_step2',array('id'=>$entity->getId()))));
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
    
    public function step2Action($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            
            $form=$this->createForm(Step2Type::class,$entity,array('method' => 'POST', 'action'=>$this->generateUrl('apachecms_api_landing_step2_submit',array('id'=>$entity->getId()))));
            $form->handleRequest($request);
            if($errors=$this->ifErrors($form)) return $errors;
            $em=$this->getDoctrine()->getManager();
            /* DELETE */
            if(key_exists('deleted',$request->get('card')) && $request->get('card')['deleted']){
                foreach ($request->get('card')['deleted'] as $key => $idService) {
                    $landingService= $this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingService')->find($idService);
                    $landingService->setIsDelete(true);
                    $em->persist($landingService);
                }
            }

            /* ADD OR EDIT */
            $files=$request->files->get('card')['picture'];
            if($request->get('card')['title']){
                foreach($request->get('card')['title'] as $key => $title){
                    if(empty($title)) continue;
                    if($request->get('card')['id'][$key])
                        $landingService= $this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingService')->find($request->get('card')['id'][$key]);
                    else
                        $landingService= new LandingService();
                    if($files && key_exists($key,$files))
                        $landingService->setPicture($this->uploadPicture($files[$key]));
                    $landingService->setTitle($title);
                    $landingService->setLanding($entity);
                    $landingService->setDescription($request->get('card')['description'][$key]);
                    $landingService->setAction($request->get('card')['action'][$key]);
                    $landingService->setLabel($request->get('card')['label'][$key]);
                    $em->persist($landingService);
                }
            }
            /* SAVE */
            $entity->setCurrentStep(3);
            $em->persist($entity);
            $em->flush();

            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_landing_add_step3',array('id'=>$id))));
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
    
    public function step3Action($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            $form=$this->createForm(Step3Type::class,$entity,array('method' => 'POST', 'action'=>$this->generateUrl('apachecms_api_landing_step3_submit',array('id'=>$entity->getId()))));
            $form->handleRequest($request);
            $formSocials=$this->createForm(LandingSocialType::class,$entity->getSocials());
            $formSocials->handleRequest($request);
            if($errors=$this->ifErrors($form)) return $errors;
            if($errors=$this->ifErrors($formSocials)) return $errors;
            /* SAVE */
            $entity->setCurrentStep(4);
            $em=$this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_landing_add_step4',array('id'=>$id))));
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
    public function step4Action($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            $form=$this->createForm(Step4Type::class,$entity,array('method' => 'POST', 'action'=>$this->generateUrl('apachecms_api_landing_step4_submit',array('id'=>$entity->getId()))));
            $form->handleRequest($request);
            
            $formChatbot=$this->createForm(LandingChatbotType::class,$entity->getChatbot());
            $formChatbot->handleRequest($request);

            if($errors=$this->ifErrors($form)) return $errors;
            if($errors=$this->ifErrors($formChatbot)) return $errors;
            /* SAVE */
            $entity->setCurrentStep(5);
            $em=$this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_landing_add_step5',array('id'=>$id))));
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
    
    public function step5Action($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            $form=$this->createForm(Step5Type::class,$entity,array('method' => 'POST', 'action'=>$this->generateUrl('apachecms_api_landing_step5_submit',array('id'=>$entity->getId()))));
            $form->handleRequest($request);
            
            $formLabels=$this->createForm(LandingLabelType::class,$entity->getLabels());
            $formLabels->handleRequest($request);

            $formSocials=$this->createForm(LandingSocialType::class,$entity->getSocials());
            $formSocials->handleRequest($request);
            
            if($errors=$this->ifErrors($form)) return $errors;
            /* SAVE */
            $em=$this->getDoctrine()->getManager();
            $entity->setDescription($entity->getLabels()->getAboutDescription());
            if($entity->getStatus()=='draft') $entity->setStatus('ready');
            $em->persist($entity);
            $em->flush();

            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_landing_view',array('id'=>$id))));
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
    
    public function publishAction($id,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            // /* SAVE */
            $now=new \DateTime();
            if($request->get('dateFrom')=='now'){
                $datePublishedFrom=new \DateTime();
                $entity->setIsPublished(true);
                $entity->setIsReview(null);
                $entity->setStatus('published');
            }else{
                if(!$request->get('datePublishedFrom'))
                    throw new Exception($this->get('translator')->trans('date.valid'),200);
                $datePublishedFrom=\DateTime::createFromFormat('d/m/Y H:i:s', $request->get('datePublishedFrom').' 00:00:00');
            }
            if($request->get('dateTo')=='undefined'){
                $datePublishedTo=null;
            }else{
                if(!$request->get('datePublishedTo'))
                    throw new Exception($this->get('translator')->trans('date.valid'),200);
                $datePublishedTo=\DateTime::createFromFormat('d/m/Y H:i:s', $request->get('datePublishedTo').' 23:59:59');
            }
            if($request->get('dateFrom')=='now' || $datePublishedFrom->format('Y-m-d') <= $now->format('Y-m-d')){
                $entity->setIsPublished(true);
                $entity->setIsReview(null);
                $entity->setStatus('published');
                if($entity->getIsActiveAi()){
                    $this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingTest')->deleteAll($entity->getId());
                    $test=new LandingTest($entity);
                    $em->persist($test);
                }
            }else{
                $entity->setIsPublished(false);
                $entity->setIsReview(null);
                $entity->setStatus('program');
            }

            $entity->setPublishedFromAt($datePublishedFrom);
            $entity->setPublishedToAt($datePublishedTo);

            
            $em->persist($entity);
            $em->flush();
            return $this->responseOk($entity);
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage(),200);
        }
    }
    
    public function publishStopAction($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            // /* SAVE */
            $entity->setIsPublished(false);
            $entity->setPublishedFromAt(null);
            $entity->setPublishedToAt(null);
            $entity->setStatus('ready');
            $em=$this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->responseOk($entity);
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage(),200);
        }
    }
    
    public function pluginsAction($id,Request $request){
        try {
            $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            $plugins=($entity->getPlugins())?$entity->getPlugins():new LandingPlugin();
            $formPlugin=$this->createForm(LandingPluginType::class,$plugins);
            $formPlugin->handleRequest($request);
            if($errors=$this->ifErrors($formPlugin)) return $errors;
            /* SAVE */
            $em=$this->getDoctrine()->getManager();
            $em->persist($plugins);
            $entity->setPlugins($plugins);
            $em->flush();

            return $this->responseOk('OK');
        }catch (Exception $excepcion) {
            return $this->responseFail(null,200);
        }
        
    }
    
    public function contactAction($id,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();

            $entity=$em->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            $form=$this->createForm(ContactType::class);
            $form->handleRequest($request);
            if($errors=$this->ifErrors($form)) return $errors;
            
            if(!$contact=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingContact')->findOneBy(array(
                    'email'=>$form->get('email')->getData(),
                    'customer'=>$entity->getCustomer(),
                ))){
                $contact=new LandingContact();
                $contact->setName($form->get('name')->getData());
                $contact->setCustomer($entity->getCustomer());
                $contact->setEmail($form->get('email')->getData());
                $contact->setPhone($form->get('phone')->getData());
                $contact->setLanding($entity);
            }else{
                $contact->setName($form->get('name')->getData());
                $contact->setPhone($form->get('phone')->getData());
            }
            $contact->setType('Formulario'); 
            
            $em->persist($contact);
            
            $query=new LandingQuery();
            /* SAVE RELATIONSHIP WHITH STATS */
            $stats=$em->getRepository('ApachecmsBackendBundle:Stat')->find($form->get('statsId')->getData());

            $query->setQuery($form->get('query')->getData());
            if($request->get('contactService'))
                $query->setType($request->get('contactService'));
            $query->setContact($contact);
            $query->setStats($stats);
            $query->setLanding($entity);
            $em->persist($query);

            /* BEGIN SEND NOTIFICATION */
            $notifications = $this->get('notifications')->send(array(
                'title'=>'Te hicieron una consulta',
                'description'=>'Tienes una nueva consulta sobre esta landing "'.$entity->getTitle().'"',
                'type'=>'query',
                'path'=>$this->generateUrl('apachecms_frontend_landing_queries_view',array('id'=>$entity->getId(),'queryId'=>$query->getId())),
                'typeId'=>$query->getId(),
                'customer'=>$entity->getCustomer(),
                'landing'=>$entity,
                'link'=>$this->generateUrl('apachecms_frontend_notifications'),
            ));
            /* END SEND NOTIFICATION */

            $message = (new \Swift_Message($this->getParameter('title').' - Consulta'))
            ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            ->setTo($entity->getContactEmail())
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/contact.html.twig', array('query' => $query)),'text/html');
            $this->get('mailer')->send($message);

            $entity->setLeads($entity->getLeads()+1);
            $entity->setConvertions();
            $em->persist($entity);

            if($form->get('testOptionId')->getData()){
                $testOption=$em->getRepository('ApachecmsBackendBundle:LandingTestOption')->find($form->get('testOptionId')->getData());
                $testOption->setLeads($testOption->getLeads()+1);
                $testOption->setConvertions();
                $em->persist($testOption);
            }

            $em->flush();
            
            $message = (new \Swift_Message($this->getParameter('title')))
            ->setFrom(array($this->getParameter('mailer_user')=>$this->getParameter('title')))
            ->setTo($contact->getEmail())
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/contactConfirm.html.twig', array('query' => $query)),'text/html');
            $this->get('mailer')->send($message);


            return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_success',array('idLanding'=>$id,'idQuery'=>$query->getId()))));
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage(),200);
        }
        
    }
    
    public function deleteAction($id, Request $request) {
        try {
            $entity = $this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
            $form = $this->createFormBuilder()
            ->setAction(null)
            ->setMethod('DELETE')
            ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $entity->setIsDelete(true);
                $entity->setTitle($entity->getTitle().'-DELETE');
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', $this->container->getParameter('messages')['delete']['success']);
            }
            return $this->responseOk('OK');
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage(),200);
        }
    }
}
