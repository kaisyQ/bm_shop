<?php

namespace App\Dto;

class ProductListResponse
{
    /**
     * @var ProductListItem[]
     */
    private array $items;

    /**
     * @param ProductListItem[] $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * 
     * @return ProductListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * 
     * @param ProductListItem[] $items 
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
