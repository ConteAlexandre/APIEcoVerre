<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\GlassDump;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class GlassdumpFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {

            $city = new GlassDump();

            $id = getCityUuid();

            $city->setNumberBorne(mt_rand(1, 1000));
            $city->setVolume(mt_rand(10, 500));
            $city->setCoordonate('POINT(37.4220761 -122.0845187)');
            $city->setDammage(false);
            $city->setIsEnable(true);
            $city->setCityUuid($id);
            $city->setCreatedAt(new \DateTime('now'));

            $manager->persist($city);
        }

        $manager->flush();
    }
}