<?php

namespace App\Controller;

use App\Repository\GlassDumpRepository;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 *
 * @Route(path="/glassdump")
 */
class GlassDumpController
{
    private $glassDumpRepository;

    public function __construct(GlassDumpRepository $glassDumpRepository)
    {
        $this->glassDumpRepository = $glassDumpRepository;
    }

    /**
     * @Route("/create", name="add_glassDump", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addGlassDump(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $numBorn = $data['numBorn'];
        $volume = $data['volume'];
        $landMark = $data['landMark'];
        $collectDay = $data['collectDay'];
        $coordonate = $data['coordinates'];
        $damage = $data['damage'];
        $is_full = $data['isFull'];
        $is_enable = $data['isEnable'];
        $nameCity = $data['nameCity'];
        $countryCode = $data['countryCode'];

        if (empty($numBorn) || empty($volume) || empty($landMark) || empty($collectDay) || empty($coordonate) || empty($damage) || empty($is_full) || empty($is_enable)  || empty($nameCity) || empty($countryCode)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }
        $this->glassDumpRepository->saveDump($numBorn, $volume, $landMark, $collectDay, $coordonate, $damage, $is_full, $is_enable, $nameCity, $countryCode);
        return new JsonResponse(['status' => 'GlassDump create !'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/show/{id}", name="get_one_dump", methods={"GET"})
     */
    public function getOneDump($id)
    {
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        $data = [
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

        return new JsonResponse(['GlassDump' => $data], Response::HTTP_OK);

    }

    /**
     * @Route("/list", name="get_all_dump", methods={"GET"})
     */

    public function getAllDump(): JsonResponse
    {
        $dumps = $this->glassDumpRepository->findAll();
        foreach ($dumps as $dump) {
            $data[] = [
                'id' => $dump->getId(),
                'numBorn' => $dump->getNumberBorne(),
                'volume' => $dump->getVolume(),
                'landMark' => $dump->getLandmark(),
                'collectDay' => $dump->getCollectDay(),
                'coordonate' => $dump->getCoordonate(),
                'damage' => $dump->getDammage(),
                'isFull' => $dump->getIsFull(),
                'isEnable' => $dump->getIsEnable(),
                'idCity' => $dump->getId(),
                'createdAt' => $dump->getCreatedAt(),
                'updatedAt' => $dump->getUpdatedAt(),
            ];
        }
        return new JsonResponse(['GlassDumps ' => $data], Response::HTTP_OK);

    }


    /**
     * @Route("/update/{id}", name="update_dump", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateDump($id, Request $request)
    {
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        $this->glassDumpRepository->updateDump($dump, $data);
        return new JsonResponse(['status' => 'GlassDump update !']);
    }

    /**
     * @Route("/delete/{id}", name="delete_dump", methods={"DELETE"})
     */
    public function deleteDump($id)
    {
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        $this->glassDumpRepository->deleteDump($dump);
        return new JsonResponse(['status' => 'GlassDump deleted']);
    }

    /**
     * @Route("/createFromFile", name="add_glassDumps", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addGlassDumpFromFile(Request $request)
    {
        $parsed_json = json_decode($request->getContent(), true);
        $info = $parsed_json{"features"};

        $erreur = array(
            "id" => 0,
            "coordonnée" => 0,
            "nomville" => 0,
            "codepostal" => 0,
            "adresse" => 0,
        );
        $compteur = 0;

        foreach ($info as $glassdump) {

            if (!empty($glassdump{'geometry'}{'coordinates'}[0]) and !empty($glassdump{'geometry'}{'coordinates'}[1])) {
                $coord = $glassdump{'geometry'}{'coordinates'}[1] . ' ' . $glassdump{'geometry'}{'coordinates'}[0];
            } else {
                $erreur["coordonnée"]++;
            }
            if (!empty($glassdump{'properties'}{'id'}) && is_string($glassdump{'properties'}{'id'})) {
                $iddump = ($glassdump{'properties'}{'id'});
            } else {
                $erreur["id"]++;
            }
            if (!empty($glassdump{'properties'}{'commune'}) && is_string($glassdump{'properties'}{'commune'})) {
                $nomVille = ucfirst(strtolower($glassdump{'properties'}{'commune'}));
            } else {
                $erreur["nomville"]++;
            }
            if (!empty($glassdump{'properties'}{'code_com'}) && is_numeric($glassdump{'properties'}{'code_com'})) {
                $codePost = $glassdump{'properties'}{'code_com'};
            } else {
                $erreur["codepostal"]++;
            }
            if (!empty($glassdump{'properties'}{'adresse'}) && is_string($glassdump{'properties'}{'adresse'})) {
                $adresse = $glassdump{'properties'}{'adresse'};
            } else {
                $erreur["adresse"]++;
            }
            $compteur++;

            $this->glassDumpRepository->saveDump();
            unset($iddump, $coord, $nomVille, $codePost);
        }

        $allglassdump['debug']['total'] = count($info);
        $allglassdump['debug']['valide'] = $compteur;
        $allglassdump['debug']['erreur_majeure'] = count($info) - $compteur;
        $allglassdump['debug']['erreur_mineure'] = $erreur['id'];
        $allglassdump['debug']['coordonnée'] = $erreur['coordonnée'];
        $allglassdump['debug']['adresse'] = $erreur['adresse'];
        $allglassdump['debug']['codepostal'] = $erreur['codepostal'];
        $allglassdump['debug']['nomville'] = $erreur['nomville'];
        $allglassdump['debug']['id'] = $erreur['id'];

        return new JsonResponse($allglassdump, Response::HTTP_CREATED);
    }

}