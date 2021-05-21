<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Entity\Stat;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\LandingTestOption;
use Symfony\Component\HttpFoundation\Session\Session;

class StatsController extends BaseController{

    public $session;
    public function __construct(){
        $this->session = new Session();
        $this->session->set('chatbot',null);
    }

    public function saveAction($landing,Request $request){
        
        $em=$this->getDoctrine()->getManager();
        $client=$request->get('client');
        $testCase=$request->get('testCase');

        $isMobileIOS=$client['isMobileIOS'];
        $isIphone=$client['isIphone'];
        $getLanguage=$client['getLanguage'];

        $landing=$em->getRepository('ApachecmsBackendBundle:Landing')->find($landing);

        $entity=new  Stat();
        $entity->setLandingId($landing);
        $entity->setBrowser($client['getBrowser']);
        $entity->setBrowserVersion($client['getBrowserVersion']);
        $entity->setOs($client['getOS']);
        $entity->setOsVersion($client['getOSVersion']);
        $entity->setIsMobile(($client['isMobile']=='true')?true:false);
        $entity->setIsMobileMajor(($client['isMobileMajor']=='true')?true:false);
        $entity->setIsMobileAndroid(($client['isMobileAndroid']=='true')?true:false);
        $entity->setIsMobileOpera(($client['isMobileOpera']=='true')?true:false);
        $entity->setIsMobileWindows(($client['isMobileWindows']=='true')?true:false);
        $entity->setIsMobileBlackBerry(($client['isMobileBlackBerry']=='true')?true:false);
        $entity->setIsMobileIOS(($client['isMobileIOS']=='true')?true:false);
        $entity->setIsIphone(($client['isIphone']=='true')?true:false);
        $entity->setLanguage($client['getLanguage']);
        $entity->setFingerPrint($client['getFingerprint']);
        $em->persist($entity);
        
        $landing->setVisits($landing->getVisits()+1);
        $landing->setConvertions();
        $em->persist($landing);
        $testOption=null;
        if($testCase && $testCase['testId']){
            if(!$testOption=$em->getRepository('ApachecmsBackendBundle:LandingTestOption')->findOneBy(array('test'=>$testCase['testId'],'optionNumber'=>$testCase['option']))){
                $testOption= new LandingTestOption();
                $test=$em->getRepository('ApachecmsBackendBundle:LandingTest')->find($testCase['testId']);
                $testOption->setTest($test);
            }
            $testOption->setOptionNumber((int)$testCase['option']);
            $testOption->setVisits($testOption->getVisits()+1);
            $testOption->setConvertions();
            $em->persist($testOption);
        }
        $em->flush();
        
        return $this->responseOk(array('stat'=>$entity,'testOption'=>$testOption));
    }   
    public function geoAction($id,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $position=$request->get('coords');
            if($entity=$em->getRepository('ApachecmsBackendBundle:Stat')->find($id)){
                $entity->setLat($position['latitude']);
                $entity->setLng($position['longitude']);
                $entity->setAcc($position['accuracy']);
                $em->persist($entity);
                $em->flush();
            }
            return $this->responseOk($entity);
        }catch (Exception $excepcion) {
            return $this->responseOk($excepcion->getMessage());
        }
    }  
    
    public function MarkerAction($id,Request $request)
    {
        $data=array(
            'type'=>'FeatureCollection',
            'features'=>null
        );
        if($entities=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getCoords($id)->getQuery()->getScalarResult()){
            $data=array(
                'type'=>'FeatureCollection',
                'features'=>array_map(function ($entity){
                    return array('type'=>'Feature',
                        'geometry'=>array(
                            'type'=>'Point',
                            'coordinates'=>array($entity['e_lng'],$entity['e_lat'])
                        ),
                        'properties'=>array(
                        )
                    );
                },$entities)
            );
        }
        return new Response($this->get('jms_serializer')->serialize($data,'json',$this->context),200);
    }
    
    public function contactEmailAction($id,Request $request)
    {
        $data=array(
            'type'=>'FeatureCollection',
            'features'=>null
        );
        if($entities=$this->getDoctrine()->getRepository('ApachecmsBackendBundle:Stat')->getCoords($id)->getQuery()->getScalarResult()){
            $data=array(
                'type'=>'FeatureCollection',
                'features'=>array_map(function ($entity){
                    return array('type'=>'Feature',
                        'geometry'=>array(
                            'type'=>'Point',
                            'coordinates'=>array($entity['e_lng'],$entity['e_lat'])
                        ),
                        'properties'=>array(
                        )
                    );
                },$entities)
            );
        }
        return new Response($this->get('jms_serializer')->serialize($data,'json',$this->context),200);
    }
    
}
