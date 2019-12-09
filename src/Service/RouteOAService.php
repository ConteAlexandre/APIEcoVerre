<?php


namespace App\Service;

use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="id de la ressource",
 *      required=true,
 *      @OA\Schema(type="string")
 * ),
 * @OA\Response(
 *     response="NotFound",
 *     description="La ressource n'existe pas",
 *     @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Cette ressource n'existe pas")
 *      )
 * ),
 * @OA\Response(
 *     response="NoAuthorized",
 *     description="Vous n'avez pas accès à cette page",
 *     @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Vous n'avez pas l'autorisation")
 * )
 * )
 */
class RouteOAService
{

}