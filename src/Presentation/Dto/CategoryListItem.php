<?php

namespace App\Presenstation\Dto;


class CategoryListItem
{
    private int $id;
    private string $name;
    private string $slug;

    public function __construct(int $id, string $name, string $slug)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
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
