<?php

namespace App\Repository;

use App\Entity\ClassTopic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassTopic|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassTopic|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassTopic[]    findAll()
 * @method ClassTopic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassTopicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassTopic::class);
    }

    // /**
    //  * @return ClassTopic[] Returns an array of ClassTopic objects
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
    public function findOneBySomeField($value): ?ClassTopic
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
