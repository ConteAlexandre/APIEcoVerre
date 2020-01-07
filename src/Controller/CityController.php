<?php

namespace App\Controller;

use App\Entity\City;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="allcity", methods={"GET"})
     */
    public function city()
    {


        $city = $this->getDoctrine()->getRepository(City::class)->findAllCity();

        $response = new JsonResponse($city);

        return $response;

    }

     /**
     * @Route("/city/{id}", name="onecity", methods={"GET"})
     */
    public function cityById($id)
    {
        $city = $this->getDoctrine()->getRepository(City::class)->findCityById($id);

        $response = new JsonResponse($city);

        return $response;
    }

    /**
     * @Route("/city/delete/{id}", name="delcity", methods={"DELETE"})
     */
    public function deleteCity($id)
    {
        $city = $this->getDoctrine()->getRepository(City::class)->deleteCity($id);

        $response = new JsonResponse($city);

        return $response;
    }

}
