<?php

use App\Dto\CommentListItem;

class CommentList
{

    /** @var CommentListItem[] */
    private array $items;
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return CommentListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CommentListItem[] $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }
}
