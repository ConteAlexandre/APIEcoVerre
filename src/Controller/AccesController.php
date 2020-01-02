<?php


namespace App\Controller;


use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccesController extends AbstractController
{

    /**
     * @OA\Post(
     *     path="/registration",
     *     tags={"Acces"},
     *     @OA\Response(
     *          response="200",
     *          description="registration for user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserCreate"))
     *     )
     * )
     */
    public function registrationController()
    {

    }

}