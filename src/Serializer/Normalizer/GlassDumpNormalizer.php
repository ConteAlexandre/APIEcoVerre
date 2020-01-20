<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GlassDump",
 *     description="Schema GlassDump Général",
 *     @OA\Property(type="string", property="id", description="uuid"),
 *     @OA\Property(type="integer", property="number_borne", description="numéro de la borne"),
 *     @OA\Property(type="integer", property="volume", description="Volume de la Benne total"),
 *     @OA\Property(type="string", property="landmark", description="point de repère"),
 *     @OA\Property(type="string", property="collect_day", description="Jour de collecte"),
 *     @OA\Property(type="number", format="double", property="coordonate", description="geography de postgis"),
 *     @OA\Property(type="string", format="date-time", property="created_at", description="date de création"),
 *     @OA\Property(type="string", format="date-time", property="updated_at", description="date de de modif"),
 *     @OA\Property(type="boolean", property="dammage", description="Endommagé ou non"),
 *     @OA\Property(type="boolean", property="is_full", description="Pleine ou non"),
 *     @OA\Property(type="boolean", property="is_enable", description="Active ou non")
 * )
 *
 * @OA\Schema(
 *     schema="GlassDumpList",
 *     description="Schema de lit GlassDump",
 *     @OA\Property(type="integer", property="number_borne", description="numéro de la borne"),
 *     @OA\Property(type="number", format="double", property="coordonate", description="geography de postgis"),
 *     @OA\Property(type="string", format="date-time", property="created_at", description="date de création"),
 *     @OA\Property(type="boolean", property="dammage", description="Endommagé ou non"),
 *     @OA\Property(type="boolean", property="is_full", description="Pleine ou non"),
 *     @OA\Property(type="boolean", property="is_enable", description="Active ou non")
 * )
 *
 * @OA\Schema(
 *     schema="GlassDumpSingle",
 *     description="Only GlassDump",
 *     allOf={@OA\Schema(ref="#/components/schemas/GlassDumpList")},
 *     @OA\Property(type="integer", property="volume", description="Volume de la Benne total"),
 *     @OA\Property(type="string", property="landmark", description="point de repère"),
 *     @OA\Property(type="string", property="collect_day", description="Jour de collecte"),
 *     @OA\Property(type="string", format="date-time", property="updated_at", description="date de de modif"),
 * )
 */
class GlassDumpNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        // Here: add, edit, or delete some data

        return $data;
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof \App\Entity\BlogPost;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
