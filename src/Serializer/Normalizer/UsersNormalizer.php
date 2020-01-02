<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Users",
 *     description="schema global for user",
 *     @OA\Property(type="string", description="uuid", property="id"),
 *     @OA\Property(type="string", description="username", property="username"),
 *     @OA\Property(type="string", description="mail of user", property="mail"),
 *     @OA\Property(type="string", description="password of user", property="password"),
 *     @OA\Property(type="string", description="token for forgot password", property="token"),
 *     @OA\Property(type="string", description="adress of user", property="adress"),
 *     @OA\Property(type="string", description="role for user for wave", property="roles"),
 *     @OA\Property(type="string", format="date-time", description="date created", property="created_at"),
 *     @OA\Property(type="string", format="date-time", description="date update", property="updated_at"),
 *     @OA\Property(type="boolean", description="activ or not", property="is_enable"),
 * )
 *
 * @OA\Schema(
 *     schema="UserCreate",
 *     description="schema for sign up",
 *     @OA\Property(type="string", description="username", property="username"),
 *     @OA\Property(type="string", description="mail of use", property="mail"),
 *     @OA\Property(type="string", description="password of user", property="password")
 * )
 *
 * @OA\Schema(
 *     schema="UserProfile",
 *     description="update user",
 *     @OA\Property(type="string", description="username", property="username"),
 *     @OA\Property(type="string", description="mail of user", property="mail"),
 *     @OA\Property(type="string", description="password of user", property="password"),
 *     @OA\Property(type="string", description="adress of user", property="adress"),
 * )
 */
class UsersNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
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
