<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 *
 * @Route(path="/city")
 */
class CityController
{
    private $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @Route("/add", name="add_city", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function addCity(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];
        $county_code = $data['countyCode'];
        $region = $data['region'];
        $mail_city = $data['mailCity'];
        if (empty($name) || empty($county_code) || empty($region) || empty($mail_city)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }
        $this->cityRepository->saveCity($name, $county_code, $region, $mail_city);
        return new JsonResponse(['status' => 'City add !'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/get/{id}", name="get_one_city", methods={"GET"})
     */
    public function getOneCity($id)
    {
        $city = $this->cityRepository->findOneBy(['id' => $id]);
        $data = [
            'id' => $city->getId(),
            'name' => $city->getName(),
            'countyCode' => $city->getCountyCode(),
            'region' => $city->getRegion(),
            'mailCity' => $city->getMailCity(),
            'createdAt' => $city->getCreatedAt(),
            'updatedAt' => $city->getUpdatedAt(),
        ];
        return new JsonResponse(['city' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/list", name="get_all_city", methods={"GET"})
     */
    public function getAllCity(): JsonResponse
    {
        $citys = $this->cityRepository->findAll();
        foreach ($citys as $city) {
            $data[] = [
                'id' => $city->getId(),
                'name' => $city->getName(),
                'countyCode' => $city->getCountyCode(),
                'region' => $city->getRegion(),
                'mailCity' => $city->getMailCity(),
                'createdAt' => $city->getCreatedAt(),
                'updatedAt' => $city->getUpdatedAt(),
            ];
        }
        return new JsonResponse(['citys' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/update/{id}", name="update_city", methods={"PUT"})
     */
    public function updateCity($id, Request $request): JsonResponse
    {
        $city = $this->cityRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);
        $this->cityRepository->updateCity($city, $data);
        return new JsonResponse(['status' => 'city updated!']);
    }

    /**
     * @Route("/delete/{id}", name="delete_city", methods={"DELETE"})
     */
    public function deleteCity($id): jsonResponse
    {
        $city = $this->cityRepository->findOneBy(['id' => $id]);
        $this->cityRepository->removeCity($city);
        return new JsonResponse(['status' => 'city deleted']);
    }
}