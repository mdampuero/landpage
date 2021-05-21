<?php

namespace Apachecms\ApiBundle\Controller;

use Apachecms\BackendBundle\Entity\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FilesController extends BaseController{

	public function uploadAction(Request $request){
		$files=$request->files->get('files');
		if($files){
			foreach ($files as $key => $file) {
				if($file->getMimeType()!='image/jpeg' && $file->getMimeType()!='image/png' && $file->getMimeType()!='image/jpg' && $file->getMimeType()!='image/gif' )
					return $this->response->setContent($this->serializer->serialize(array('response'=>false,'error'=>array('message'=>'Formato no soportado')), 'json'));
				$em=$this->getDoctrine()->getManager();
				$entity= new File();
				$fileName=$this->uploadPicture($files[$key]);
				$entity->setCustomer($this->get('security.token_storage')->getToken()->getUser());
				$entity->setName($fileName);
				$em->persist($entity);
				$em->flush();
				$names[]=array('id'=>$entity->getId(),'name'=>$fileName);
			}
		}
		return $this->responseOk($names);
	}
	
	public function removeAction($file,Request $request){
		$em=$this->getDoctrine()->getManager();
		$entity=$em->getRepository('ApachecmsBackendBundle:File')->find($file);
		$entity->setIsDelete(true);
		$em->persist($entity);
		$em->flush();
		return $this->responseOk($file);
	}

}
