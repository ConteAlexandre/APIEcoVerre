<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="City",
 *     description="Schema City Général",
 *     @OA\Property(type="string", description="uuid", property="id"),
 *     @OA\Property(type="string", description="name", property="name"),
 *     @OA\Property(type="integer", description="departement", property="county_code"),
 *     @OA\Property(type="string", description="name region", property="region"),
 *     @OA\Property(type="string", format="date-time", description="date création", property="created_at"),
 * )
 * @OA\Schema(
 *     schema="CitySingle",
 *     description="Listing d'une villle",
 *     allOf={@OA\Schema(ref="#/components/schemas/City")},
 *     @OA\Property(type="string", description="mail client", property="mail_city"),
 *     @OA\Property(type="string", format="date-time", description="date de modif", property="updated_at")
 * )
 */
class CityNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
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
