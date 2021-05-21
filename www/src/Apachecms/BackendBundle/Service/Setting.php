<?php

namespace Apachecms\BackendBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class Setting
 *
 * @package Apachecms\FrontendBundle\Service
 */
class Setting
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $settings=$this->em->getRepository('ApachecmsBackendBundle:Setting')->find('setting');
        return $settings;
    }
    
}