<?php declare(strict_types=1);

namespace App\Presenstation\Response;

final class SearchListResponse
{
    /**
     * @var SearchListItem[]
     */
    private array $items;

    /**
     * @param SearchListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return SearchListItem[] $items
     */

    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param SearchListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
