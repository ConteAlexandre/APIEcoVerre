<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\GlassDump;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method GlassDump|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlassDump|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlassDump[]    findAll()
 * @method GlassDump[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlassDumpRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, GlassDump::class);
        $this->manager = $manager;
    }


    public function saveDump($numBorn,$volume,$landMark,$collectDay,$coordonate,$damage,$is_full,$is_enable,$idCity)
    {
        $newBen = new GlassDump();

        empty($numBorn) ? true  : $newBen->setNumberBorne($numBorn);
        empty($volume) ? true  : $newBen->setVolume($volume);
        empty($landMark) ? true  : $newBen->setLandmark($landMark);
        empty($collectDay) ?  true : $newBen->setCollectDay($collectDay);
        empty($coordonate) ? true : $newBen->setCoordonate($coordonate);
        empty($damage) ? true : $newBen->setDammage($damage);
        empty($is_full) ? true  : $newBen->setIsFull($is_full);
        empty($is_enable) ? true : $newBen->setIsEnable($is_enable);
        empty($idCity) ? true : $newBen->setCityUuid($idCity);

        $this->manager->persist($newBen);
        $this->manager->flush();


    }

    public function updateDump(GlassDump $dump, $data)
    {
        empty($data['numBorn']) ? true : $dump->setNumberBorne($data['numBorn']);
        empty($data['volume']) ? true : $dump->setVolume($data['volume']);
        empty($data['landMark']) ? true : $dump->setLandmark($data['landMark']);
        empty($data['collectDay']) ? true : $dump->setCollectDay($data['collectDay']);
        empty(($data['coordonate'])) ? true : $dump->setCoordonate($data['coordonate']);
        empty($data['dammage']) ? true : $dump->setDammage($data['dammage']);
        empty($data['isFull']) ? true : $dump->setIsFull($data['isFull']);
        empty($data['isEnable']) ? true : $dump->setIsEnable($data['isEnable']);
        empty($data['idCity']) ? true : $dump->setCityUuid($data['idCity']);
        $dump->setUpdatedAt(new \Datetime("now"));
        $this->manager->flush();
    }

    public function deleteDump(GlassDump $dump)
    {
        $this->manager->remove($dump);
        $this->manager->flush();
    }
}
