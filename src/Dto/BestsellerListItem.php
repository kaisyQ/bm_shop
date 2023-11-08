<?php

namespace App\Dto;
class BestsellerListItem
{
    private int $id;
    private string $name;
    private int $price;
    private ?int $discountPrice = null;

    public function __construct(int $id, string $name, int $price, ?int $discountPrice = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->discountPrice = $discountPrice;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
    public function setPrice(string $price): self
    {
        $this->price = $price;
        return $this;
    }
    public function getDiscountPrice(): ?int
    {
        return $this->discountPrice;
    }

    public function setDiscountPrice(?int $discountPrice): self
    {
        $this->discountPrice = $discountPrice;
        return $this;
    }
}
