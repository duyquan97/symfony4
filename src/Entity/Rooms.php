<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomsRepository")
 */
class Rooms
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $province;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $district;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featured;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="json")
     */
    private $service = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $room_total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $room_booked;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weekend;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $holiday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $people;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $toilet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bedRoom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="rooms")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getFeatured(): ?string
    {
        return $this->featured;
    }

    public function setFeatured(?string $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }


    public function getService(): ?array
    {
        return $this->service;
    }

    public function setService(?array $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRoomTotal(): ?int
    {
        return $this->room_total;
    }

    public function setRoomTotal(?int $room_total): self
    {
        $this->room_total = $room_total;

        return $this;
    }

    public function getRoomBooked(): ?int
    {
        return $this->room_booked;
    }

    public function setRoomBooked(?int $room_booked): self
    {
        $this->room_booked = $room_booked;

        return $this;
    }

    public function getWeekend(): ?float
    {
        return $this->weekend;
    }

    public function setWeekend(?float $weekend): self
    {
        $this->weekend = $weekend;

        return $this;
    }

    public function getHoliday(): ?float
    {
        return $this->holiday;
    }

    public function setHoliday(?float $holiday): self
    {
        $this->holiday = $holiday;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPeople(): ?int
    {
        return $this->people;
    }

    public function setPeople(?int $people): self
    {
        $this->people = $people;

        return $this;
    }

    public function getToilet(): ?int
    {
        return $this->toilet;
    }

    public function setToilet(?int $toilet): self
    {
        $this->toilet = $toilet;

        return $this;
    }

    public function getBedRoom(): ?int
    {
        return $this->bedRoom;
    }

    public function setBedRoom(?int $bedRoom): self
    {
        $this->bedRoom = $bedRoom;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
