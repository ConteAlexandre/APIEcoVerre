<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use OpenApi\Annotations as OA;
use Symfony\Component\Routing\Annotation\Route;


class GlassDumpController extends AbstractController
{

    /**
     * @OA\Get(
     *     path="/glassdump/list",
     *     tags={"GlassDump"},
     *     @OA\Response(
     *          response="200",
     *          description="This GlassDump",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpList"))
     *     )
     * )
     *
     * @Route("/glassdump/list", name="list_glassdump")
     */
    public function listGlassDump()
    {

    }

    /**
     * @OA\Get(
     *     path="/glassdump/show/{id}",
     *     tags={"GlassDump"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="GlassDump",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     *
     * @Route("/glassdump/show/{id}", name="show_glassdump")
     */
    public function showGlassDump()
    {

    }

    /**
     * @OA\Post(
     *     path="/glassdump/create",
     *     tags={"GlassDump"},
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateGlassDump"),
     *     @OA\Response(
     *          response="200",
     *          description="GlassDump create",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
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
     * @Route("/glassdump/create", name="create_glassdump")
     */
    public function createGlassDump()
    {

    }

    /**
     * @OA\Put(
     *     path="/glassdump/update/{id}",
     *     tags={"GlassDump"},
     *     @OA\RequestBody(ref="#/components/requestBodies/CreateUpdateGlassDump"),
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Update Reussi",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpSingle"))
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
     * @Route("/glassdump/update/{id}", name="update_glassdump")
     */
    public function updateGlassDump()
    {

    }

}