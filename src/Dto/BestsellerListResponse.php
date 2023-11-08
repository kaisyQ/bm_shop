<?php


namespace App\Dto;

class BestsellerListResponse
{
    /**
     * @var BestsellerListItem[]
     */
    private array $items;

    /**
     * 
     * @param BestsellerListItem[] $items 
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * 
     * @return BestsellerListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * 
     * @param BestsellerListItem[] $items 
     * @return self
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
