<?php

namespace Apachecms\BackendBundle\Service;
use Apachecms\BackendBundle\Entity\Notification;

use Doctrine\ORM\EntityManager;

/**
 * Class Notifications
 *
 * @package Apachecms\BackendBundle\Service
 */
class Notifications
{
    protected $em;
    protected $mailer;
    protected $templating;
    protected $container;

    public function __construct(EntityManager $em,$mailer,$templating,$container)
    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function send($data=array())
    {
        $notification=new Notification();
        $notification->setTitle($data['title']);
        $notification->setDescription($data['description']);
        $notification->setType($data['type']);
        $notification->setPath($data['path']);
        $notification->setTypeId($data['typeId']);
        $notification->setCustomer($data['customer']);
        $toEmail=$data['customer']->getEmail();
        $link=null;
        if(key_exists('landing',$data)){
            // $toEmail=$data['landing']->getContactEmail();
        }            
        if(key_exists('link',$data)){
            $link=$data['link'];
            // $toEmail=$data['landing']->getContactEmail();
        }            

        $this->em->persist($notification);
        $this->em->flush();
        $message = (new \Swift_Message($this->container->getParameter('title').' - '.$data['title']))
            ->setFrom(array($this->container->getParameter('mailer_user')=>$this->container->getParameter('title')))
            ->setTo($toEmail)
            ->setReplyTo($this->container->getParameter('no.reply'))
            ->setBody($this->templating->render('ApachecmsBackendBundle:Emails:Landing/notification.html.twig', array('h3' => $data['title'],'link'=>$link,'message'=>$data['description'])),'text/html');
        $this->mailer->send($message);
        return $notification;
    }
}