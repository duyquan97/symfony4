<?php

namespace App\Entity;

use App\Repository\RoomDateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomDateRepository::class)
 */
class RoomDate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $discount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $roomCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $roomBooked;

    /**
     * @ORM\ManyToOne(targetEntity=Room2::class, inversedBy="roomDates")
     */
    private $roomId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
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

    public function getRoomCount(): ?int
    {
        return $this->roomCount;
    }

    public function setRoomCount(?int $roomCount): self
    {
        $this->roomCount = $roomCount;

        return $this;
    }

    public function getRoomBooked(): ?int
    {
        return $this->roomBooked;
    }

    public function setRoomBooked(?int $roomBooked): self
    {
        $this->roomBooked = $roomBooked;

        return $this;
    }

    public function getRoomId(): ?Room2
    {
        return $this->roomId;
    }

    public function setRoomId(?Room2 $roomId): self
    {
        $this->roomId = $roomId;

        return $this;
    }
}
