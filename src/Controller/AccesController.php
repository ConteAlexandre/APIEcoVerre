<?php


namespace App\Controller;


use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccesController extends AbstractController
{

    /**
     * @OA\Post(
     *     path="/registration",
     *     tags={"Access"},
     *     @OA\RequestBody(ref="#/components/requestBodies/Signup"),
     *     @OA\Response(
     *          response="200",
     *          description="registration for user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserCreate"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/registration", name="registration")
     */
    public function registrationController()
    {

    }

    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Access"},
     *     @OA\RequestBody(ref="#/components/requestBodies/Signin"),
     *     @OA\Response(
     *          response="200",
     *          description="signin is ok",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserCreate"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/login", name="login")
     */
    public function login()
    {

    }
}