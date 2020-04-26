<?php

namespace App\Repository;

use App\Entity\Bagages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bagages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bagages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bagages[]    findAll()
 * @method Bagages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BagagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bagages::class);
    }

    // /**
    //  * @return Bagages[] Returns an array of Bagages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bagages
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
