<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoricRepository")
 */
class Historic
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
     * @ORM\ManyToOne(targetEntity="App\Entity\UserGlassdump")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_glassdump_uuid;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_full;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_dammage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

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

    public function getUserGlassdumpUuid(): ?UserGlassdump
    {
        return $this->user_glassdump_uuid;
    }

    public function setUserGlassdumpUuid(?UserGlassdump $user_glassdump_uuid): self
    {
        $this->user_glassdump_uuid = $user_glassdump_uuid;

        return $this;
    }

    public function getIsFull(): ?bool
    {
        return $this->is_full;
    }

    public function setIsFull(bool $is_full): self
    {
        $this->is_full = $is_full;

        return $this;
    }

    public function getIsDammage(): ?bool
    {
        return $this->is_dammage;
    }

    public function setIsDammage(bool $is_dammage): self
    {
        $this->is_dammage = $is_dammage;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
