<?php


namespace App\Service;

use OpenApi\Annotations as OA;

/**
 * @OA\Parameter(
 *      name="id",
 *      in="path",
 *      description="id de la ville",
 *      required=true,
 *      @OA\Schema(type="string")
 * ),
 * @OA\Response(
 *     response="NotFound",
 *     description="La ressource n'existe pas",
 *     @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Cette ressource n'existe pas")
 *      )
 * )
 */
class RouteOAService
{

}