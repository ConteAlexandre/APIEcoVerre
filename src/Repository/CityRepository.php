<?php

namespace App\Repository;

use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registery, EntityManagerInterface $manager)
    {
        parent::__construct($registery, City::class);
        $this->manager = $manager;
    }

    public function saveCity($name,$county_code,$region,$mail_city)
    {
        $newCity = new City();

        $newCity->setName($name)
            ->setCountyCode($county_code)
            ->setRegion($region)
            ->setMailCity($mail_city);
        $this->manager->persist($newCity);
        $this->manager->flush();
    }

    public function updateCity(City $city, $data)
    {
        empty($data['name']) ? true : $city->setName($data['name']);
        empty($data['countyCode']) ? true : $city->setName($data['countyCode']);
        empty($data['region']) ? true : $city->setName($data['region']);
        empty($data['mailCity']) ? true : $city->setName($data['mailCity']);

        $this->manager->flush();
    }

    public function removeCity(City $city)
    {
        $this->manager->remove($city);
        $this->manager->flush();
    }

}