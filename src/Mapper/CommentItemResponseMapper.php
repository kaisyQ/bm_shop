<?php

namespace App\Mapper;

use App\Dto\CommentList;
use App\Dto\CommentListItem;
use App\Entity\Comment;

final class CommentItemResponseMapper
{
    /**
     * @param Comment[] $comments
     * @return CommentList
     */
    public function mapFromCommentArray (array $comments): CommentList
    {
        return new CommentList(
            array_map(
                fn ($comment) =>
                new CommentListItem(
                    $comment->getId(),
                    $comment->getUsername(),
                    $comment->getText(),
                    $comment->getStars(),
                    $comment->getCreatedAt(),
                ),
                $comments
            )
        );
    }

    public function mapFromComment (Comment $comment): CommentListItem
    {
        return new CommentListItem(
            $comment->getId(),
            $comment->getUsername(),
            $comment->getText(),
            $comment->getStars(),
            $comment->getCreatedAt(),
        );
    }
}