<?php

namespace App\Presenstation\Dto;

class BestsellerListItem
{
    private int $id;
    private string $name;
    private string $slug;
    private int $price;
    private ?int $discountPrice = null;

    /**
     * @var string[] $images
     */
    private array $images;
    public function __construct(int $id, string $name, string $slug, int $price, array $images, ?int $discountPrice = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->price = $price;
        $this->discountPrice = $discountPrice;
        $this->images = $images;
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

    public function getPrice(): int
    {
        return $this->price;
    }
    public function setPrice(int $price): self
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
    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;
        return $this;
    }
    public function getSlug(): string
    {
        return $this->slug;
    }
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
}
