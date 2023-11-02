<?php

namespace App\Dto;


class CategoryListResponse
{
    /**
     * @var CategoryListItem[]
     */
    private array $categories;

    /**
     * @param CategoryListItem[] $categories
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }
    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }
}
