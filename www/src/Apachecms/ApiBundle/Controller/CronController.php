<?php

namespace Apachecms\ApiBundle\Controller;
use Apachecms\BackendBundle\Entity\LandingTest;

class CronController extends BaseController
{
    public function testAction(){
        $dateTime=new \DateTime();
        $message = (new \Swift_Message($this->container->getParameter('title').' - Test cron'))
        ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
        ->setTo('mdampuero@gmail.com')
        ->setReplyTo($this->container->getParameter('no.reply'))
        ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/notification.html.twig', array('h3' => 'Test cron',
        'link'=>null,'message'=>$dateTime->format('d/m/Y H:i:s'))),'text/html');
        $this->get('mailer')->send($message);
        return $this->responseOk('OK');
    }

    public function lockValidateEmailAction(){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $dateTime->modify('-'.$this->getParameter('days_to_validate').' days');
        $customers=$em->getRepository('ApachecmsBackendBundle:Customer')
        ->getAll()
        ->andWhere('e.isValidate =:validate')
        ->andWhere('e.isLocked =:isLocked')
        ->andWhere('e.createdAt >= :from AND e.createdAt <=:to ')
        ->setParameter('isLocked',false)
        ->setParameter('validate',false)
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->getQuery()->getResult();
        foreach ($customers as $key => $customer) {
            $customer->setIsLocked(true);
            $customer->setLockedType('not_validate');
            $customer->setLockedDescription('account.locked.by.not.validate');
            $em->persist($customer);
            $em->flush();
        }
        return $this->responseOk('OK');
    }

    public function alertTrialAction($days=1){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $dateTime->modify('+'.$days.' days');
        $customers=$em->getRepository('ApachecmsBackendBundle:Customer')
        ->getAll()
        ->andWhere('e.useTrial =:useTrial')
        ->andWhere('e.isLocked =:isLocked')
        ->andWhere('e.expirationPlan >= :from AND e.expirationPlan <=:to ')
        ->setParameter('isLocked',false)
        ->setParameter('useTrial',true)
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->getQuery()->getResult();
        foreach ($customers as $key => $customer) {
            $message='Tu versión de prueba esta a '.$days.' días de caducar, ingresa para renovar tu plan antes del vencimiento';
            if($days==1) 
                $message='Tu versión de prueba caduca mañana, ingresa para renovar tu plan para evitar suspensiones en el servicio.';
            $message = (new \Swift_Message($this->container->getParameter('title').' - Aviso de vencimiento'))
            ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
            ->setTo($customer->getEmail())
            ->setReplyTo($this->container->getParameter('no.reply'))
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/notification.html.twig', array('h3' => 'Aviso de vencimiento',
            'link'=>$this->generateUrl('apachecms_frontend_dashboard'),'message'=>$message)),'text/html');
            $this->get('mailer')->send($message);
        }
        return $this->responseOk('OK');
    }

    public function blockTrialAction(){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $customers=$em->getRepository('ApachecmsBackendBundle:Customer')
        ->getAll()
        ->andWhere('e.useTrial =:useTrial')
        ->andWhere('e.isLocked =:isLocked')
        ->andWhere('e.expirationPlan >= :from AND e.expirationPlan <=:to ')
        ->setParameter('isLocked',false)
        ->setParameter('useTrial',true)
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->getQuery()->getResult();
        foreach ($customers as $key => $customer) {
            $customer->setIsLocked(true);
            $customer->setLockedType('trial_expiret');
            $customer->setLockedDescription('Tu versión de prueba ha caducado, renueva tu plan ahora.');
            $em->persist($customer);
            $em->flush();
            $message = (new \Swift_Message($this->container->getParameter('title').' - Vencimiento de versión de prueba'))
            ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
            ->setTo($customer->getEmail())
            ->setReplyTo($this->container->getParameter('no.reply'))
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/notification.html.twig', array('h3' => 'Vencimiento de versión de prueba',
            'link'=>$this->generateUrl('apachecms_frontend_dashboard'),'message'=>'Tu versión de prueba ha caducado, ingresa para renovar tu plan')),'text/html');
            $this->get('mailer')->send($message);
        }
        return $this->responseOk('OK');
    }
    
    public function alertPlanAction($days=1){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $dateTime->modify('+'.$days.' days');
        $customers=$em->getRepository('ApachecmsBackendBundle:Customer')
        ->getAll()
        ->andWhere('e.useTrial =:useTrial')
        ->andWhere('e.isLocked =:isLocked')
        ->andWhere('e.expirationPlan >= :from AND e.expirationPlan <=:to ')
        ->setParameter('isLocked',false)
        ->setParameter('useTrial',false)
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->getQuery()->getResult();
        foreach ($customers as $key => $customer) {
            $message='Tu plan esta a '.$days.' días de caducar, ingresa para renovarlo antes del vencimiento';
            if($days==1) 
                $message='Tu plan caduca mañana, ingresa para renovarlo para y evitar suspensiones en el servicio.';
            $message = (new \Swift_Message($this->container->getParameter('title').' - Aviso de vencimiento'))
            ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
            ->setTo($customer->getEmail())
            ->setReplyTo($this->container->getParameter('no.reply'))
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/notification.html.twig', array('h3' => 'Aviso de vencimiento',
            'link'=>$this->generateUrl('apachecms_frontend_dashboard'),'message'=>$message)),'text/html');
            $this->get('mailer')->send($message);
        }
        return $this->responseOk('OK');
    }
    
    public function blockPlanAction(){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $customers=$em->getRepository('ApachecmsBackendBundle:Customer')
        ->getAll()
        ->andWhere('e.useTrial =:useTrial')
        ->andWhere('e.isLocked =:isLocked')
        ->andWhere('e.expirationPlan >= :from AND e.expirationPlan <=:to ')
        ->setParameter('isLocked',false)
        ->setParameter('useTrial',false)
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->getQuery()->getResult();
        foreach ($customers as $key => $customer) {
            $customer->setIsLocked(true);
            $customer->setLockedType('trial_expiret');
            $customer->setLockedDescription('Tu plan ha caducado, renuévalo ahora.');
            $em->persist($customer);
            $em->flush();
            $message = (new \Swift_Message($this->container->getParameter('title').' - Vencimiento de plan'))
            ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
            ->setTo($customer->getEmail())
            ->setReplyTo($this->container->getParameter('no.reply'))
            ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/notification.html.twig', array('h3' => 'Vencimiento de plan',
            'link'=>$this->generateUrl('apachecms_frontend_dashboard'),'message'=>'Tu plan ha caducado, ingresa para renovarlo')),'text/html');
            $this->get('mailer')->send($message);
        }
         return $this->responseOk('OK');
    }

    public function startPublicationAction(){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $landings=$em->getRepository('ApachecmsBackendBundle:Landing')
        ->getAll()
        ->andWhere('e.status =:status')
        ->andWhere('c.isDelete =:isDelete')
        ->andWhere('c.isLocked =:isLocked')
        ->andWhere('e.publishedFromAt >= :from AND e.publishedFromAt <=:to ')
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->setParameter('status','program')
        ->setParameter('isDelete',false)
        ->setParameter('isLocked',false)
        ->getQuery()->getResult();
        foreach ($landings as $key => $landing) {
            $landing->setIsPublished(true);
            $landing->setIsReview(null);
            $landing->setStatus('published');
            $this->getDoctrine()->getRepository('ApachecmsBackendBundle:LandingTest')->deleteAll($landing->getId());
            $test=new LandingTest($landing);
            $em->persist($test);
            $em->persist($landing);
            $em->flush();

            /* BEGIN SEND NOTIFICATION */
            $notifications = $this->get('notifications')->send(array(
                'title'=>'Publicación automática',
                'description'=>'Se publicó automáticamente tu landing "'.$landing->getTitle().'"',
                'type'=>'landing',
                'path'=>$this->generateUrl('apachecms_frontend_landing_view',array('id'=>$landing->getId())),
                'typeId'=>$landing->getId(),
                'customer'=>$landing->getCustomer(),
                'link'=>$this->generateUrl('apachecms_frontend_notifications')
            ));
            /* END SEND NOTIFICATION */

        }
        return $this->responseOk('OK');
    }

    public function stopPublicationAction(){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $dateTime->modify('-1 days');
        $landings=$em->getRepository('ApachecmsBackendBundle:Landing')
        ->getAll()
        ->andWhere('e.status =:status')
        ->andWhere('c.isDelete =:isDelete')
        ->andWhere('c.isLocked =:isLocked')
        ->andWhere('e.publishedToAt >= :from AND e.publishedToAt <=:to ')
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->setParameter('status','published')
        ->setParameter('isDelete',false)
        ->setParameter('isLocked',false)
        ->getQuery()->getResult();
        foreach ($landings as $key => $landing) {
            $landing->setIsPublished(false);
            $landing->setPublishedFromAt(null);
            $landing->setPublishedToAt(null);
            $landing->setStatus('ready');
            $em->persist($landing);
            $em->flush();
            /* BEGIN SEND NOTIFICATION */
            $notifications = $this->get('notifications')->send(array(
                'title'=>'Detención automática',
                'description'=>'Se detuvo automáticamente la publicación de tu landing "'.$landing->getTitle().'"',
                'type'=>'landing',
                'path'=>$this->generateUrl('apachecms_frontend_landing_view',array('id'=>$landing->getId())),
                'typeId'=>$landing->getId(),
                'customer'=>$landing->getCustomer(),
                'link'=>$this->generateUrl('apachecms_frontend_notifications')
            ));
            /* END SEND NOTIFICATION */
        }
        return $this->responseOk('OK');
    }
    
    public function stopTestAIAction(){
        $em=$this->getDoctrine()->getManager();
        $dateTime=new \DateTime();
        $tests=$em->getRepository('ApachecmsBackendBundle:LandingTest')
        ->getAll()
        ->leftJoin('e.landing','l')
        ->andWhere('l.status =:status')
        ->andWhere('e.isComplete !=:isComplete')
        ->andWhere('e.toAt >= :from AND e.toAt <=:to ')
        ->setParameter('from',$dateTime->format('Y-m-d 00:00:00'))
        ->setParameter('to',$dateTime->format('Y-m-d 23:59:59'))
        ->setParameter('status','published')
        ->setParameter('isComplete',true)
        ->getQuery()->getResult();
        foreach ($tests as $key => $test) {
            // $message = (new \Swift_Message($this->container->getParameter('title').' - Test de Inteligencia artificial terminado'))
            // ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
            // ->setTo($test->getLanding()->getCustomer()->getEmail())
            // ->setReplyTo($this->container->getParameter('no.reply'))
            // ->setBody($this->renderView('ApachecmsBackendBundle:Emails:Landing/testAIStop.html.twig', 
            //     array(
            //         'h3' => 'Test de Inteligencia artificial terminado',
            //         'test'=>$test,
            //         'link'=>$this->generateUrl('apachecms_frontend_landing_view',array('id'=>$test->getLanding()->getId()))
            //     )
            // ),'text/html');
            // $this->get('mailer')->send($message);
            $test->setIsComplete(true);
            $em->persist($test);
            $em->flush();
            /* BEGIN SEND NOTIFICATION */
            $notifications = $this->get('notifications')->send(array(
                'title'=>'Test de Inteligencia artificial terminado',
                'description'=>'Ha finalizado el test de Inteligencia artificial de tu landing "'.$test->getLanding()->getTitle().'", ingresa para ver los resultados, 
                puedes cambiar los textos que no tuvieron demasiadas conversiones y volver a lanzar un nuevo test.',
                'type'=>'landing',
                'path'=>$this->generateUrl('apachecms_frontend_landing_view',array('id'=>$test->getLanding()->getId())).'#ia',
                'typeId'=>$test->getLanding()->getId(),
                'customer'=>$test->getLanding()->getCustomer(),
                'link'=>$this->generateUrl('apachecms_frontend_notifications')
            ));
            /* END SEND NOTIFICATION */
        }
        return $this->responseOk('OK');
    }

}
