<?php

namespace Apachecms\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Apachecms\FrontendBundle\Form\Landing\ContactType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HelperController extends Controller
{
    public function pageStaticAction($code){
        return $this->render('ApachecmsFrontendBundle:Helper:pageStatic.html.twig',array(
            'entity'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Page')->findOneBy(array(
                'code'=>$code,
                'isDelete'=>0
            ))
        ));
    }
   

}
