<?php

namespace Apachecms\ApiBundle\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;

class SettingController extends BaseController{
 
    public function getAction(){
        try {
            return $this->responseOk($this->get('setting')->getData());
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage());
        }
    }
    
}
