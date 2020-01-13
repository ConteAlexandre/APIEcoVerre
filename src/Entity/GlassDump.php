<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GlassDumpRepository")
 */
class GlassDump
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_borne;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $volume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $landmark;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $collect_day;

    /**
     * @ORM\Column(type="geography", options={"geometry_type"="POINT"})
     */
    private $coordonate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dammage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_full;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_enable;

    private $id_bin;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cityName;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $countryCode;

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

    public function getNumberBorne(): ?string
    {
        return $this->number_borne;
    }

    public function setNumberBorne(?string $number_borne): self
    {
        $this->number_borne = $number_borne;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(?int $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getLandmark(): ?string
    {
        return $this->landmark;
    }

    public function setLandmark(?string $landmark): self
    {
        $this->landmark = $landmark;

        return $this;
    }

    public function getCollectDay(): ?string
    {
        return $this->collect_day;
    }

    public function setCollectDay(?string $collect_day): self
    {
        $this->collect_day = $collect_day;

        return $this;
    }

    public function getCoordonate()
    {
        return $this->coordonate;
    }

    public function setCoordonate($coordonate): self
    {
        //ST_GeometryFromText('POINT(1.3993400071067 43.70909700286)', 4326);
        $this->coordonate = $coordonate;

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

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDammage(): ?bool
    {
        return $this->dammage;
    }

    public function setDammage(bool $dammage): self
    {
        $this->dammage = $dammage;

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

    public function getIsEnable(): ?bool
    {
        return $this->is_enable;
    }

    public function setIsEnable(bool $is_enable): self
    {
        $this->is_enable = $is_enable;

        return $this;
    }


    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(string $cityName): self
    {
        $this->cityName = $cityName;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

}