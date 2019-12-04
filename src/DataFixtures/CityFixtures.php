<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $city = new City();
            $city->setName('city' . $i);
            $city->setCountyCode(mt_rand(1000, 10000));
            $city->setRegion('city'.$i);
            $city->setCreatedAt(new \DateTime('now'));

        $manager->persist($city);
        }

        $manager->flush();
    }
}