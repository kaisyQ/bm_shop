<?php declare(strict_types=1);

namespace App\Presentation\Response;

final class ProductListResponse
{
    /**
     * @var ProductListItem[]
     */
    private array $items;

    private int $total;

    /**
     * @param ProductListItem[] $items
     */
    public function __construct(array $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
    }

    /**
     * @return ProductListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * 
     * @param ProductListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;
        return $this;
    }
}
