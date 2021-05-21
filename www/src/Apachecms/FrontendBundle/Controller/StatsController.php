<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\BackendBundle\Form\Landing\Step1Type;
use Apachecms\BackendBundle\Form\Landing\Step2Type;
use Apachecms\BackendBundle\Form\Landing\Step3Type;
use Apachecms\BackendBundle\Form\Landing\Step4Type;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\Landing;

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class StatsController extends Controller
{
    public function __construct(TokenStorage $storage = null,RouterInterface $router){
        if($storage->getToken()->getUser()->getUrlDestination()){
            $urlDestination=json_decode($storage->getToken()->getUser()->getUrlDestination(),true);
            header('Location: '.$router->generate($urlDestination['url'],$urlDestination['params']));
            exit();
        }
    }

    public function indexAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Stats:index.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id),
            'statsByDate'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByDate($entity)),
            'statsByBrowser'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByBrowser($entity)),
            'statsByDevice'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByDevice($entity)),
            'statsByOS'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByOS($entity)),
            'statsByLanguage'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByLanguage($entity)),
        ));
    }
    public function byGeoAction($id,Request $request){
        return $this->render('ApachecmsFrontendBundle:Stats:byGeo.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id)
        ));
    }
    public function byBrowserAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Stats:byBrowser.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id),
            'statsByBrowser'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByBrowser($entity))
        ));
    }
    public function byDeviceAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Stats:byDevice.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id),
            'statsByDevice'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByDevice($entity))
        ));
    }
    public function byOSAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Stats:byOS.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id),
            'statsByOS'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByOS($entity))
        ));
    }
    public function byLanguageAction($id,Request $request){
        $entity=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id);
        return $this->render('ApachecmsFrontendBundle:Stats:byLanguage.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->find($id),
            'statsByLanguage'=>json_encode($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getByLanguage($entity))
        ));
    }
}
