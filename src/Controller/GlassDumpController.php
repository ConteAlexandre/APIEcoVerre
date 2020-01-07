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
    public function showGlassDumpId()
    {

    }

    /**
     * @OA\Get(
     *     path="/glassdump/show/{coordonate}",
     *     tags={"GlassDump"},
     *     @OA\Parameter(ref="#/components/parameters/coordonate"),
     *     @OA\Response(
     *          response="200",
     *          description="find glassdump",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/GlassDumpList"))
     *     ),
     *     @OA\Response(
     *          response="404",
     *          ref="#/components/responses/NotFound"
     *     )
     * )
     */
    public function showGlassDumpGeo()
    {

    }

    /**
     * @OA\Post(
     *     path="/glassdump/create",
     *     tags={"GlassDump"},
     *     security={"bearer"},
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
     *     security={"bearer"},
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

    /**
     * @OA\Delete(
     *     path="/glassdump/delete/{id}",
     *     tags={"GlassDump"},
     *     security={"bearer"},
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(
     *          response="200",
     *          description="Delete Reussi",
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
    public function deleteGlassDump()
    {

    }

}