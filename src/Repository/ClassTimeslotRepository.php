<?php

namespace App\Repository;

use App\Entity\ClassTimeslot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassTimeslot|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassTimeslot|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassTimeslot[]    findAll()
 * @method ClassTimeslot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassTimeslotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassTimeslot::class);
    }

    // /**
    //  * @return ClassTimeslot[] Returns an array of ClassTimeslot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClassTimeslot
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
