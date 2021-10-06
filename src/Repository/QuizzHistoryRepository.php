<?php

namespace App\Repository;

use App\Entity\QuizzHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuizzHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzHistory[]    findAll()
 * @method QuizzHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzHistory::class);
    }

    // /**
    //  * @return QuizzHistory[] Returns an array of QuizzHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizzHistory
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
