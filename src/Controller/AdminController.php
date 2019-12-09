<?php


namespace App\Controller;


use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/user/list", name="list_user")
     */
    public function listUsers()
    {
        $city = $this->getDoctrine()->getManager()->getRepository(City::class)->findAllCity();
        $response = new JsonResponse([
            'succes' => true,
            'data' => $city
        ]);
        return $response;
    }

    /**
     * @param Request $request
     * @Route("/user/create", name="create_user")
     * @return array
     */
    public function createCity(Request $request)
    {
        return [
            'city' => [
                $request->get('name'),
                $request->get('countyCode'),
                $request->get('region')
            ]
        ];
    }
}