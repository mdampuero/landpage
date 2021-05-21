<?php

namespace Apachecms\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseController
{
    public function indexAction()
    {
        // $notifications = $this->get('notifications');
        // dump($notifications->send());
        // exit();
        // echo '<pre>';
        // print_r($setting->getData());
        // echo '</pre>';
        // exit();
        return $this->render('ApachecmsBackendBundle:Dashboard:index.html.twig',array(
            'pathBase'=>'apachecms_backend_landings',
        ));
    }

    public function loadAction(){
		return $this->response->setContent($this->serializer->serialize(
            array('data'=>$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Landing')->listAll()
            ->andWhere('e.isPublished=:isPublished')->setParameter('isPublished',true)
            ->andWhere('e.isReview IS NULL')
            ->getQuery()->getResult()), 'json'
		));
	}
}
