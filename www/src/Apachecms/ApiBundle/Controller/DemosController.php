<?php

namespace Apachecms\ApiBundle\Controller;

class DemosController extends BaseController
{

    public function getAction($id){
        return $this->responseOk($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Demo')->find($id));
    }
    
    public function getAllAction(){
        return $this->responseOk($this->getDoctrine()->getRepository('ApachecmsBackendBundle:Demo')->findAll());
    }

}
