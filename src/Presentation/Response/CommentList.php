<?php declare(strict_types=1);


namespace App\Presentation\Response;

final class CommentList
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
