<?php

namespace Apachecms\BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Apachecms\BackendBundle\Entity\Plan;

class PlansFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface{

    private $container;

    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager){
        $plan1 = new Plan();
        $plan1->setName("form.plan.1");
        $plan1->setPrice(0);
        $manager->persist($plan1);
        
        $plan2 = new Plan();
        $plan2->setName("form.plan.2");
        $plan2->setPrice(300);
        $manager->persist($plan2);
        
        $plan3 = new Plan();
        $plan3->setName("form.plan.3");
        $plan3->setPrice(500);
        $manager->persist($plan3);
        
        $manager->flush();
    }
    
    public function getOrder(){
        return 1;
    }
}
