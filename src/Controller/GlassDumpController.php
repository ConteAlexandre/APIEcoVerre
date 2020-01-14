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

        if (empty($numBorn) || empty($volume) || empty($landMark) || empty($collectDay) || empty($coordonate) || empty($damage) || empty($is_full) || empty($is_enable) || empty($nameCity) || empty($countryCode)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }
        $this->glassDumpRepository->saveDump($numBorn, $volume, $landMark, $collectDay, $coordonate, $nameCity, $countryCode);
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
        $this->glassDumpRepository->savedumpfile($info);

        return new JsonResponse(['status' => 'GlassDump all add or or updated'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/dumpNextTo/{gps}", name="get_glassDumps_next", methods={"GET"})
     */
    public function getByGPS($gps)
    {
        $pts = explode(",", $gps);
        $pts1 = $pts[0];
        $pts2 = $pts[1];
        $dumps = $this->glassDumpRepository->nextTo($pts1, $pts2);

        return new JsonResponse(['GlassDump' => $dumps], Response::HTTP_OK);
    }
}