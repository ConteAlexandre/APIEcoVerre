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

SELECT id, name, address, ST_Distance(geom, ref_geom) AS distance
FROM Seattle_Starbucks
CROSS JOIN (SELECT ST_MakePoint(-122.325959, 47.625138)::geography AS ref_geom) AS r
WHERE ST_DWithin(geom, ref_geom, 1000)
ORDER BY ST_Distance(geom, ref_geom);
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
