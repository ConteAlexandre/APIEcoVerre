<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;

class HistoricController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/historic/list",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Response(
     *          response="200",
     *          description="List Historic",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          ref="#/components/responses/NoAuthorized"
     *     ),
     * )
     *
     * @Route("/historic/list", name="list_historic")
     */
    public function listHistoric()
    {

    }

    /**
     * @OA\Get(
     *     path="/historic/show/{id}",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="show single historic",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
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
     * @Route("/hostiric/show/{id}", name="show_historic")
     */
    public function showHistoric()
    {

    }

    /**
     * @OA\Delete(
     *     path="/historic/delete/{id}",
     *     tags={"Historic"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Delete Historic",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Historic"))
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
     * @Route("/historic/delete/{id}", name="delete_historic")
     */
    public function deleteHistoric()
    {

    }
}