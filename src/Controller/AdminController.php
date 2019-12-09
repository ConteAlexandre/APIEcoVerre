<?php


namespace App\Controller;


use App\Entity\City;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/city/list",
     *     @OA\Response(
     *          response="200",
     *          description="Nos Villes",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/City"))
     *     )
     * )
     * @Route("/city/list", name="list_user")
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
     *     path="/city/{id}",
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
     * @Route("/city/list", name="list_user")
     */
    public function showCity()
    {

    }
    /**
     * @OA\Post(
     *     path="/city/{id}",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/UpdateCity"),
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
     * @Route("/city/list", name="list_user")
     */
    public function updateCity()
    {

    }

}