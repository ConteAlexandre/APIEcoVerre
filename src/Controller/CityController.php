<?php


namespace App\Controller;


use App\Entity\City;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/city/list",
     *     tags={"City"},
     *     @OA\Response(
     *          response="200",
     *          description="Nos Villes",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/City"))
     *     )
     * )
     * @Route("/city/list", name="list_city")
     */
    public function listCity()
    {
        $city = $this->getDoctrine()->getManager()->getRepository(City::class)->findAllCity();
        $response = new JsonResponse([
            'succes' => true,
            'data' => $city
        ]);
        return $response;
    }

    /**
     * @OA\Get(
     *     path="/city/show/{id}",
     *     tags={"City"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Ville",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     * )
     * )
     * @Route("/city/list", name="show_city")
     */
    public function showCity()
    {

    }

    /**
     * @OA\Put(
     *     path="/city/update/{id}",
     *     tags={"City"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateCity"),
     *     @OA\Response(
     *          response="200",
     *          description="Ville",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     * )
     * )
     * @Route("/city/update/{id}", name="update_city")
     */
    public function updateCity()
    {

    }

    /**
     * @OA\Post(
     *     path="/city/create/{id}",
     *     tags={"City"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateCity"),
     *     @OA\Response(
     *          response="200",
     *          description="Ville",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     * )
     * )
     * @Route("/city/create/{id}", name="create_city")
     */
    public function createCity()
    {

    }

}