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
}