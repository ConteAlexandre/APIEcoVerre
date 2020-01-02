<?php


namespace App\Controller;


use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @OA\Get(
     *     path="/users/list",
     *     tags={"Users"},
     *     security={"bearer"},
     *     @OA\Response(
     *          response="200",
     *          description="list Users",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Users"))
     *     ),
     *     @OA\Response(
     *          response="403",
     *          description="no authorization",
     *          ref="#/components/responses/NoAuthorized"
     *     )
     * )
     *
     * @Route("/users/list", name="list_users")
     */
    public function listUsers()
    {

    }

    /**
     * @OA\Get(
     *     path="/users/show/{id}",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     tags={"Users"},
     *     security={"bearer"},
     *     @OA\Response(
     *          response="200",
     *          description="profile user for admin",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Users"))
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
     * @Route("/users/show/{id}", name="show_users")
     */
    public function showUsers()
    {

    }


    /**
     * @OA\Get(
     *     path="/user/profile/{id}",
     *     tags={"Users"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="profile for the user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserProfile"))
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
     * @Route("/user/profile/{id}", name="profile_user")
     */
    public function profileUser()
    {

    }

    /**
     * @OA\Put(
     *     path="/user/update/{id}",
     *     tags={"Users"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\RequestBody(ref="#/components/requestBodies/ProfileUser"),
     *     @OA\Response(
     *          response="200",
     *          description="update profile the user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/UserProfile"))
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
     * @Route("/user/update/{id}", name="update_user")
     */
    public function updateUser()
    {

    }

    /**
     * @OA\Delete(
     *     path="/users/delete/{id}",
     *     tags={"Users"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Delete User",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Users"))
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
     * @Route("/users/delete/{id}", name="delete_user")
     */
    public function deleteUsers()
    {

    }

}