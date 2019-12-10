<?php


namespace App\Controller;


use App\Entity\City;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     *
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
     *          description="Show City",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/city/list", name="show_city")
     */
    public function showCity()
    {

    }

    /**
     * @OA\Post(
     *     path="/city/create",
     *     tags={"City"},
     *     security={"bearer"},
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateCity"),
     *     @OA\Response(
     *          response="200",
     *          description="Create City",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     *
     * @Route("/city/create/{id}", name="create_city")
     */
    public function createCity()
    {

    }

    /**
     * @OA\Put(
     *     path="/city/update/{id}",
     *     tags={"City"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateCity"),
     *     @OA\Response(
     *          response="200",
     *          description="Update City",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     *
     * @Route("/city/update/{id}", name="update_city")
     */
    public function updateCity()
    {

    }

    /**
     * @OA\Delete(
     *     path="/city/delete/{id}",
     *     tags={"City"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Delete City",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitySingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     *
     * @Route("/city/update/{id}", name="update_city")
     */
    public function deleteCity()
    {

    }

}