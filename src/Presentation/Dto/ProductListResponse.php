<?php

namespace App\Dto;

class ProductListResponse
{
    /**
     * @var ProductListItem[]
     */
    private array $items;

    private int $total;

    /**
     * @param ProductListItem[] $items
     * @param int $total
     */
    public function __construct(array $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
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

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total 
     * @return self
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }
}
