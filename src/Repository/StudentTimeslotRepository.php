<?php

namespace App\Repository;

use App\Entity\StudentTimeslot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentTimeslot|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentTimeslot|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentTimeslot[]    findAll()
 * @method StudentTimeslot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentTimeslotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentTimeslot::class);
    }

    // /**
    //  * @return StudentTimeslot[] Returns an array of StudentTimeslot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentTimeslot
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
