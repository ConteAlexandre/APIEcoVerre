<?php

namespace App\Repository;

use App\Entity\GlassDump;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GlassDump|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlassDump|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlassDump[]    findAll()
 * @method GlassDump[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlassDumpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlassDump::class);
    }

    // /**
    //  * @return GlassDump[] Returns an array of GlassDump objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GlassDump
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
