<?php

namespace App\Repository;

use App\Entity\UserGlassdump;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserGlassdump|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGlassdump|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGlassdump[]    findAll()
 * @method UserGlassdump[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGlassdumpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserGlassdump::class);
    }

    // /**
    //  * @return UserGlassdump[] Returns an array of UserGlassdump objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserGlassdump
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
