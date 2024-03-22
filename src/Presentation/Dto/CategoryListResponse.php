<?php

namespace App\Dto;


class CategoryListResponse
{
    /**
     * @var CategoryListItem[]
     */
    private array $items;

    /**
     * @param CategoryListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CategoryListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
