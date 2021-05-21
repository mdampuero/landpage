<?php

namespace Apachecms\BackendBundle\Repository;

/**
 * LandingServiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LandingServiceRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAll(){
		return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
		->setParameter('isDelete',false)
        ->orderBy("e.id","DESC");
    }
    
	public function listAll(){
		return $this->getAll()
		->select('e.id','e.name','e.price',"e.createdAt");
	}

	public function getUniqueNotDeleted(array $parameters){
        return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
        ->setParameter('isDelete',false)
        ->andWhere('e.name= :name')
        ->setParameter('name',$parameters['name'])
        ->setMaxResults(1)->getQuery()->getResult();
    }
}
