<?php

namespace App\Repository;

use App\Entity\StudentSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentSchedule[]    findAll()
 * @method StudentSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentSchedule::class);
    }

    // /**
    //  * @return StudentSchedule[] Returns an array of StudentSchedule objects
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
    public function findOneBySomeField($value): ?StudentSchedule
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
