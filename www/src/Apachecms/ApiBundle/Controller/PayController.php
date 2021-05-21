<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Apachecms\BackendBundle\Entity\Stat;
use Apachecms\FrontendBundle\Form\Pay\PayType;
use Symfony\Component\HttpFoundation\Response;
use Apachecms\BackendBundle\Entity\Notification;
use Apachecms\BackendBundle\Entity\CustomerBalance;

class PayController extends BaseController{
 
    public function payAction($plan,$transaction,$back=null,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $plan=$em->getRepository('ApachecmsBackendBundle:Plan')->find($plan);
            $transactionEntity=$em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->findOneBy(array(
                'id'=>$transaction,
                'collectionStatus'=>array('reject',null)
            ));
            $customer=$this->get('security.token_storage')->getToken()->getUser();
            
            $form=$this->createForm(PayType::class,$transactionEntity);
            $form->handleRequest($request);
            if ($errors=$this->ifErrors($form)) return $errors;
        
            $em->persist($transactionEntity);
            switch ($transactionEntity->getCollectionStatus()) {
                case 'approved':
                    $this->addFlash("success",$this->get('translator')->trans('pay.approved'));
                    $now=new \DateTime();
                    if($customer->getExpirationPlan()<$now || $customer->getUseTrial()==true){
                        $customer->setExpirationPlan($transactionEntity->getExpiredAt());
                    }else{
                        $expiredAt=new \DateTime($customer->getExpirationPlan()->format('Y-m-d H:i:s'));
                        if($transactionEntity->getType()==12){
                            $newExpiredAt=$expiredAt->modify('+1 years');
                        }else{
                            $newExpiredAt=$expiredAt->modify('+1 months');
                        }
                        $customer->setExpirationPlan($newExpiredAt);
                    }                    
                    $customer->setPlan($plan);
                    $customer->setUseTrial(false);
                    $customer->setIsLocked(false);
                    if($back != 'renew')
                        $customer->setUrlDestination(json_encode(array('url'=>'security_frontend_profile','params'=>array())));
                    
                    break;
                case 'pending':
                    $this->addFlash("warning",$this->get('translator')->trans('pay.pending'));
                    $customer->setPlan($plan);
                    $customer->setUseTrial(false);
                    $customer->setIsLocked(false);
                    if($back != 'renew')
                        $customer->setUrlDestination(json_encode(array('url'=>'security_frontend_profile','params'=>array())));
                    break;
                case 'in_process':
                    $this->addFlash("warning",$this->get('translator')->trans('pay.pending'));
                    $customer->setPlan($plan);
                    $customer->setUseTrial(false);
                    $customer->setIsLocked(false);
                    if($back != 'renew')
                        $customer->setUrlDestination(json_encode(array('url'=>'security_frontend_profile','params'=>array())));
                    break;
                case 'reject':
                    $this->addFlash("rejected",$this->get('translator')->trans('pay.rejected'));
                    break;
                default:
                    # code...
                    break;
            }
            $em->persist($customer);
            $em->flush();
            switch ($back) {
                case 'renew':
                    return $this->responseOk(array('to'=>$this->generateUrl('apachecms_frontend_account_plans')));
                    break;
                
                default:
                    return $this->responseOk(array('to'=>$this->generateUrl('security_frontend_profile')));
                    break;
            }

        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage());
        }
    }  

    public function IPNAction($transaction,Request $request){
        try {
            $em=$this->getDoctrine()->getManager();
            $transactionEntity=$em->getRepository('ApachecmsBackendBundle:CustomerTransaction')->findOneBy(array(
                'id'=>$transaction,
                'collectionStatus'=>array('in_process','pending')
            ));
            if($transactionEntity){
                $transactionEntity->setCollectionStatus('approved');
                $em->persist($transactionEntity);
                $customer=$transactionEntity->getCustomer();
                $now=new \DateTime();
                if($customer->getExpirationPlan()<$now || $customer->getUseTrial()==true){
                    $customer->setExpirationPlan($transactionEntity->getExpiredAt());
                }else{
                    $expiredAt=new \DateTime($customer->getExpirationPlan()->format('Y-m-d H:i:s'));
                    $newExpiredAt=$expiredAt->modify('+1 months');
                    $customer->setExpirationPlan($newExpiredAt);
                }
                $customer->setUseTrial(false);
                $customer->setIsLocked(false);
                $em->persist($customer);
                $em->flush();

                /* BEGIN SEND NOTIFICATION */
                $notifications = $this->get('notifications')->send(array(
                    'title'=>'Pago acreditado',
                    'description'=>'Se realizó el pago de tu plan por el monto de: $'.$transactionEntity->getImport().' (Id de transacción: #'.$transactionEntity->getCollectionId().')',
                    'type'=>'plan',
                    'path'=>$this->generateUrl('apachecms_frontend_account_plans'),
                    'typeId'=>null,
                    'customer'=>$customer,
                    'link'=>$this->generateUrl('apachecms_frontend_account_plans')
                ));
            }
            return $this->responseOk($transactionEntity);
        }catch (Exception $excepcion) {
            return $this->responseFail($excepcion->getMessage());
        }
    }  
    
    
}
