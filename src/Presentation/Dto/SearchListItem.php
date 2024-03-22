<?php

namespace App\Dto;


class SearchListItem
{
    private int $id;
    private string $name;
    private string $slug;
    private string $image;

    public function __construct(int $id, string $name, string $slug, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
    public function getImage(): string
    {
        return $this->image;
    }
}
