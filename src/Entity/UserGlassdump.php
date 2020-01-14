<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserGlassdumpRepository")
 */
class UserGlassdump
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_uuid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GlassDump")
     * @ORM\JoinColumn(nullable=false)
     */
    private $glassdump_uuid;


    private $id_bin;

    public function __construct()
    {
        $this->id_bin = new ArrayCollection();
        $this->id = Uuid::uuid4();
        $this->created_at = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserUuid(): ?Users
    {
        return $this->user_uuid;
    }

    public function setUserUuid(?Users $user_uuid): self
    {
        $this->user_uuid = $user_uuid;

        return $this;
    }

    public function getGlassdumpUuid(): ?GlassDump
    {
        return $this->glassdump_uuid;
    }

    public function setGlassdumpUuid(?GlassDump $glassdump_uuid): self
    {
        $this->glassdump_uuid = $glassdump_uuid;

        return $this;
    }
}
