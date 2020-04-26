<?php

namespace App\Repository;

use App\Entity\CompagnieAeriennes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompagnieAeriennes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompagnieAeriennes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompagnieAeriennes[]    findAll()
 * @method CompagnieAeriennes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagnieAeriennesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompagnieAeriennes::class);
    }

    // /**
    //  * @return CompagnieAeriennes[] Returns an array of CompagnieAeriennes objects
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
    public function findOneBySomeField($value): ?CompagnieAeriennes
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
