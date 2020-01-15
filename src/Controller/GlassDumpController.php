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
        $nameCity = $data['nameCity'];
        $countryCode = $data['countryCode'];

        $dump = $this->glassDumpRepository->findOneBy(['number_borne' => $numBorn]);

        if (empty($data['numBorn']) || empty($data['volume']) || empty($data['landMark']) || empty($data['collectDay']) || empty($data['coordinates']) || empty($data['damage']) || empty($data['isFull']) || empty($data['isEnable']) || empty($data['nameCity']) || empty($data['countryCode'])) {
            return new JsonResponse('Missing parameter - please try again');
        }

        $dump = $this->glassDumpRepository->findOneBy(['number_borne' => $numBorn]);

        if (empty($dump)) {
            $this->glassDumpRepository->saveDump($numBorn, $volume, $landMark, $collectDay, $coordonate, $nameCity, $countryCode);
            return new JsonResponse(['status' => 'new glass dump created !'], Response::HTTP_CREATED);
        }
        else {
            return new JsonResponse('glass dump already exist');
        }
    }

    /**
     * @Route("/show/{id}", name="get_one_dump", methods={"GET"})
     */
    public function getOneDump($id)
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            return new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
        }

        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        if (!empty($dump)) {
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
            return new JsonResponse(['status' => $data], Response::HTTP_OK);
        } else {
            return new JsonResponse(['erreur' => "Not valid Id"], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/list", name="get_all_dump", methods={"GET"})
     */
    public function getAllDump(): JsonResponse
    {
        $dumps = $this->glassDumpRepository->findAll();
        if (!empty($dumps)) {
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
            return new JsonResponse(['status ' => $data], Response::HTTP_OK);
        } else {
            return new JsonResponse(['erreur ' => 'No data'], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/update/{id}", name="update_dump", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function updateDump($id, Request $request)
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            return new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
        }
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        if (!empty($dump) && !empty($data)) {
            $this->glassDumpRepository->updateDump($dump, $data);
            return new JsonResponse(['status' => 'GlassDump update !']);
        } else {
            return new JsonResponse(['erreur' => 'Not valid data given']);
        }
    }

    /**
     * @Route("/delete/{id}", name="delete_dump", methods={"DELETE"})
     */
    public function deleteDump($id) //faire sécurité admin
    {
        if (!is_string($id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $id) !== 1)) {
            return new JsonResponse(['status' => "not the good format of id"], Response::HTTP_OK);
        }
        $dump = $this->glassDumpRepository->findOneBy(['id' => $id]);
        if (!empty($dump)) {
            $this->glassDumpRepository->deleteDump($dump);
            return new JsonResponse(['status' => 'GlassDump deleted']);
        } else {
            return new JsonResponse(['erreur' => 'Not valid Id']);
        }
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
        $this->glassDumpRepository->savedumpfile($info);

        return new JsonResponse(['status' => 'GlassDump all add or or updated'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/dumpNextTo/{gps}", name="get_glassDumps_next", methods={"GET"})
     */
    public function getByGPS($gps)
    {
        $rayon = 2000;
        $dumps = $this->glassDumpRepository->nextToCoord($gps, $rayon);
        if ($dumps === false) {
            return new JsonResponse(['erreur' => $dumps], Response::HTTP_OK);
        } else {
            return new JsonResponse(['status' => $dumps], Response::HTTP_OK);
        }
    }

    /**
     * @Route("/dumpIn/{city}", name="get_glassDumps_city", methods={"GET"})
     */
    public function getByCity($city)
    {
        if (!empty(is_string($city))) {
            $city = ucfirst(strtolower($city));
            $dumps = $this->glassDumpRepository->inCity($city);

            if ($dumps === false) {
                return new JsonResponse(['erreur' => "Wrong city name"], Response::HTTP_OK);
            } else {
                return new JsonResponse(['status' => $dumps], Response::HTTP_OK);
            }
        }
        else {
            return new JsonResponse(['erreur' => "Wrong city name"], Response::HTTP_OK);
        }
    }
}