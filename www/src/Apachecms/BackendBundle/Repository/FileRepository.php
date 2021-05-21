<?php

namespace Apachecms\BackendBundle\Repository;

/**
 * FileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FileRepository extends \Doctrine\ORM\EntityRepository
{
    public function findRandByIndustry($industry,$limit=1){
		return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
		->setParameter('isDelete',false)
        ->andWhere('e.industry = :industry')
        ->setParameter('industry',$industry)
        ->setMaxResults($limit)
        ->orderBy("RAND()");
    }
    public function findByIndustry($industry){
		return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
		->setParameter('isDelete',false)
        ->andWhere('e.industry = :industry')
        ->setParameter('industry',$industry);
    }
}
