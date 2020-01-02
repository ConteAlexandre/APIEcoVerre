<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Historic",
 *     description="schema Historic Listing",
 *     @OA\Property(type="string", description="uuid", property="id"),
 *     @OA\Property(type="string", description="id user", property="user_glassdump_uuid"),
 *     @OA\Property(type="boolean", description="if glassdump full", property="is_full"),
 *     @OA\Property(type="boolean", description="if glassdump is break", property="is_damage"),
 *     @OA\Property(type="string", format="date-time", description="creation date", property="is_created")
 * )
 */
class HistoricNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
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
