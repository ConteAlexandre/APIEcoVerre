<?php

namespace App\Repository;

use App\Entity\Historic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Historic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Historic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Historic[]    findAll()
 * @method Historic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoricRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    public function __construct(ManagerRegistry $registry , EntityManagerInterface $manager)
    {
        parent::__construct($registry, Historic::class);
        $this->manager = $manager;
    }

    public function saveHistoric($usersId, $glassDumpId, $isFUll, $isDamage, $isCheck)
    {
        $newHist = new Historic();

        empty($usersId) ? true : $newHist->setUserId($usersId);
        empty($glassDumpId) ? true : $newHist->setGlassdumpId($glassDumpId);
        empty($isFUll) ? true : $newHist->setIsFull($isFUll);
        empty($isDamage) ? true : $newHist->setIsDamage($isDamage);
        empty($isCheck) ? true : $newHist->setIsCheck($isCheck);

        $this->manager->persist($newHist);
        $this->manager->flush();
    }

    public function updateHist(Historic $historic , $data)
    {
        empty($data['userId']) ? true : $historic->setUserId($data['userId']);
        empty($data['glassDumpId']) ? true : $historic->setGlassdumpId($data['glassDumpId']);
        empty($data['isFull']) ? true : $historic->setIsFull($data['isFull']);
        empty($data['isDamage']) ? true : $historic->setIsDamage($data['isDamage']);
        empty($data['isCheck']) ? true : $historic->setIsCheck($data['isCheck']);
        $historic->setUpdatedAt(new \DateTime("now"));
        $this->manager->flush();
    }

    public function deleteHist(Historic $historic)
    {
        $this->manager->remove($historic);
        $this->manager->flush();
    }

    // /**
    //  * @return Historic[] Returns an array of Historic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Historic
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
