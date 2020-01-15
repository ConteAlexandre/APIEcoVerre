<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoricRepository")
 */
class Historic
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $glassdump_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_full;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_damage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_check;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getGlassdumpId(): ?string
    {
        return $this->glassdump_id;
    }

    public function setGlassdumpId(string $glassdump_id): self
    {
        $this->glassdump_id = $glassdump_id;

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

    public function getIsDamage(): ?bool
    {
        return $this->is_damage;
    }

    public function setIsDamage(bool $is_damage): self
    {
        $this->is_damage = $is_damage;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getIsCheck(): ?bool
    {
        return $this->is_check;
    }

    public function setIsCheck(bool $is_check): self
    {
        $this->is_check = $is_check;

        return $this;
    }
}
