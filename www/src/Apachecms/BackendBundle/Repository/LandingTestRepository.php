<?php

namespace Apachecms\BackendBundle\Repository;

/**
 * LandingTestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LandingTestRepository extends \Doctrine\ORM\EntityRepository
{
    public function deleteAll($landing){
        $em = $this->getEntityManager();
        $query = "UPDATE landing_test t SET t.is_delete=1 WHERE t.landing='".$landing."' AND t.is_complete=0";
        $statement = $em->getConnection()->prepare($query);
        $result=$statement->execute();
    }
    public function getAll(){
		return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
		->setParameter('isDelete',false)
        ->orderBy("e.id","DESC");
	}
    public function getActive($landing){
		return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
        ->andWhere('e.landing = :landing')
        ->andWhere('(e.fromAt <= :now AND e.toAt >= :now) OR (e.isComplete = :isComplete)')
		->setParameter('isDelete',false)
		->setParameter('isComplete',true)
		->setParameter('landing',$landing)
		->setParameter('now',new \DateTime())
        ->orderBy("e.id","DESC");
    }
    
}
