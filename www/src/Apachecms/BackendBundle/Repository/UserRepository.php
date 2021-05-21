<?php

namespace Apachecms\BackendBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository {

	public function getAll(){
		return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
		->setParameter('isDelete',false)
        ->orderBy("e.id","DESC");
	}
	public function listAll(){
		return $this->getAll()
        ->select('e.id','e.email','e.picture',
        'CASE 
            WHEN e.role = \'ROLE_ADMIN\' THEN \'Administrador\' 
            WHEN e.role = \'ROLE_SUPER\' THEN \'Superusuario\' 
            WHEN e.role = \'ROLE_OPER\' THEN \'Operador\' 
            WHEN e.role = \'ROLE_USER\' THEN \'Usuario\' 
            ELSE \'Otro\' END AS role',
        'e.name',"DATE_FORMAT(e.createdAt,'%d/%m/%Y %H:%i') as createdAt");
	}
	public function getUniqueNotDeleted(array $parameters){
        return $this->createQueryBuilder('e')
        ->select('e')
        ->where('e.isDelete = :isDelete')
        ->setParameter('isDelete',false)
        ->andWhere('e.email= :email')
        ->setParameter('email',$parameters['email'])
        ->setMaxResults(1)->getQuery()->getResult();
    }
}