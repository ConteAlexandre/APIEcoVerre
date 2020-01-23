<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use OpenApi\Annotations as OA;

/**
 * @OA\RequestBody(
 *     request="CreateUpdateGlassDump",
 *     required=true,
 *     @OA\JsonContent(
 *          required={"number_one", "volume", "landmark", "collect_day", "coordonate"},
 *          @OA\Property(type="integer", property="number_one"),
 *          @OA\Property(type="integer", property="volume"),
 *          @OA\Property(type="string", property="landmark"),
 *          @OA\Property(type="string", property="collect_day"),
 *          @OA\Property(type="number", format="double", property="coordonate", description="geography PostGis"),
 *     )
 * )
 */
class GlassDumpForm extends AbstractType
{

}