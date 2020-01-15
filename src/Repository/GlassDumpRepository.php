<?php

namespace App\Repository;

use App\Entity\GlassDump;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Symfony\Component\HttpFoundation\Request;

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


    public function saveDump($numBorn, $volume, $landMark, $collectDay, $coordonate, $nameCity, $countryCode)
    {
        $newBen = new GlassDump();

        empty($numBorn) ? true : $newBen->setNumberBorne($numBorn);
        empty($volume) ? true : $newBen->setVolume($volume);
        empty($landMark) ? true : $newBen->setLandmark($landMark);
        empty($collectDay) ? true : $newBen->setCollectDay($collectDay);
        empty($coordonate) ? true : $newBen->setCoordonate('POINT(' . $coordonate . ')');
        empty($nameCity) ? true : $newBen->setCityName($nameCity);
        empty($countryCode) ? true : $newBen->setCountryCode($countryCode);
        $newBen->setDammage(FALSE);
        $newBen->setIsFull(FALSE);
        $newBen->setIsEnable(TRUE);

        $this->manager->persist($newBen);
        $this->manager->flush();
    }

    public function savedumpfile($info)
    {
        $compteur = 0;
        $erreur = array(
            "numBorn" => 0,
            "landMark" => 0,
            "coordonate" => 0,
            "nameCity" => 0,
            "countryCode" => 0,
        );

        foreach ($info as $glassdump) {

            $newBen = new GlassDump();

            if (!empty($glassdump{'properties'}{'id'}) && is_string($glassdump{'properties'}{'id'})) {
                $numBorn = ($glassdump{'properties'}{'id'});
            } else {
                $erreur["numBorn"]++;
            }
            if (!empty($glassdump{'properties'}{'adresse'}) && is_string($glassdump{'properties'}{'adresse'})) {
                $landMark = $glassdump{'properties'}{'adresse'};
            } else {
                $erreur["landMark"]++;
            }
            if (!empty($glassdump{'geometry'}{'coordinates'}[0]) and !empty($glassdump{'geometry'}{'coordinates'}[1])) {
                $coordonate = $glassdump{'geometry'}{'coordinates'}[0] . ' ' . $glassdump{'geometry'}{'coordinates'}[1];
            } else {
                $erreur["coordonate"]++;
            }
            if (!empty($glassdump{'properties'}{'commune'}) && is_string($glassdump{'properties'}{'commune'})) {
                $nameCity = ucfirst(strtolower($glassdump{'properties'}{'commune'}));
            } else {
                $erreur["nameCity"]++;
            }
            if (!empty($glassdump{'properties'}{'code_com'}) && is_numeric($glassdump{'properties'}{'code_com'})) {
                $countryCode = $glassdump{'properties'}{'code_com'};
            } else {
                $erreur["countryCode"]++;
            }
            $compteur++;

            $newBen->setNumberBorne($numBorn);
            $newBen->setVolume(Null);
            $newBen->setLandmark($landMark);
            $newBen->setCollectDay(Null);
            $newBen->setCoordonate('POINT(' . $coordonate . ')');
            $newBen->setDammage(FALSE);
            $newBen->setIsFull(FALSE);
            $newBen->setIsEnable(TRUE);
            $newBen->setCityName($nameCity);
            $newBen->setCountryCode($countryCode);

            $this->manager->persist($newBen);
        }
        $this->manager->flush();
        /*$allglassdump['debug']['total'] = count($info);
        $allglassdump['debug']['valide'] = $compteur;
        $allglassdump['debug']['erreur_majeure'] = count($info) - $compteur;
        $allglassdump['debug']['erreur_mineure'] = $erreur['id'];
        $allglassdump['debug']['coordonnée'] = $erreur['coordonnée'];
        $allglassdump['debug']['adresse'] = $erreur['adresse'];
        $allglassdump['debug']['codepostal'] = $erreur['codepostal'];
        $allglassdump['debug']['nomville'] = $erreur['nomville'];
        $allglassdump['debug']['id'] = $erreur['id'];*/ //gestion erreur
    }

    public function updateDump(GlassDump $dump, $data)
    {
        empty($data['numBorn']) ? true : $dump->setNumberBorne($data['numBorn']);
        empty($data['volume']) ? true : $dump->setVolume($data['volume']);
        empty($data['landMark']) ? true : $dump->setLandmark($data['landMark']);
        empty($data['collectDay']) ? true : $dump->setCollectDay($data['collectDay']);
        empty(($data['coordinate'])) ? true : $dump->setCoordonate($data['coordinate']);
        empty($data['damage']) ? true : $dump->setDammage($data['damage']);
        empty($data['isFull']) ? true : $dump->setIsFull($data['isFull']);
        empty($data['isEnable']) ? true : $dump->setIsEnable($data['isEnable']);
        empty($data['nameCity']) ? true : $dump->setCityName($data['nameCity']);
        empty($data['countryCode']) ? true : $dump->setCityName($data['countryCode']);
        $dump->setUpdatedAt(new \Datetime("now"));
        $this->manager->flush();
    }

    public function deleteDump(GlassDump $dump)
    {
        $this->manager->remove($dump);
        $this->manager->flush();
    }

    public function nextToCoord($gps, $rayon)
    {
        $pts = explode(",", $gps);
        if (!empty($pts[0]) && is_numeric($pts[0])) {
            $pts1 = $pts[0];
        } else {
            return "coordonnees invalide (separateur ,)";
        }
        if (!empty($pts[1]) && is_numeric($pts[1])) {
            $pts2 = $pts[1];
        } else {
            return "coordonnees invalide (separateur ',')";
        }

        $query = $this->createQueryBuilder('b')
            ->where("ST_DWithin(b.coordonate, Geography(ST_SetSRID(ST_Point(:val1,:val2),4326)), :val3) = true")
            ->setParameter(':val1', $pts1)
            ->setParameter(':val2', $pts2)
            ->setParameter(':val3', $rayon);
        return $query->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }

    public function inCity($city)
    {
        $dumps = $this->findBy(['cityName' => $city]);
        if (!empty($dumps)) {
            foreach ($dumps as $dump) {
                $data[] = [
                    'id' => $dump->getId(),
                    'numBorn' => $dump->getNumberBorne(),
                    'volume' => $dump->getVolume(),
                    'landMark' => $dump->getLandmark(),
                    'collectDay' => $dump->getCollectDay(),
                    'coordinate' => $dump->getCoordonate(),
                    'damage' => $dump->getDammage(),
                    'isFull' => $dump->getIsFull(),
                    'isEnable' => $dump->getIsEnable(),
                    'nameCity' => $dump->getCityName(),
                    'countryCode' => $dump->getCountryCode(),
                    'createdAt' => $dump->getCreatedAt(),
                    'updatedAt' => $dump->getUpdatedAt(),
                ];
            }
            return $data;
        }
        else {
            return false;
        }
    }
}
