<?php

namespace App\Service;

use App\Dto\CommentList;
use App\Dto\CommentListItem;
use App\Dto\CreateCommentRequest;
use App\Dto\UpdateCommentRequest;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    public function __construct(
        private CommentRepository $commentRepository,
        private EntityManagerInterface $em,
    ) {
    }

    public function getComments()
    {
        $comments = $this->commentRepository->findAll();

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

    public function getCommentById($id)
    {
        $comment = $this->commentRepository->find($id);
        if (!$comment) {
            return null;
        }

        return new CommentListItem(
            $comment->getId(),
            $comment->getUsername(),
            $comment->getText(),
            $comment->getStars(),
            $comment->getCreatedAt(),
        );
    }

    public function deleteCommentById(int $id)
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment) {
            return null;
        }

        $this->em->remove($comment);

        $this->em->flush();

        return $id;
    }
    public function createComment(CreateCommentRequest $request)
    {
        $comment = new Comment();

        $comment->setUsername($request->getUsername());
        $comment->setText($request->getText());
        $comment->setStars($request->getStars());

        $this->em->persist($comment);

        $this->em->flush();

        return new CommentListItem(
            $comment->getId(),
            $comment->getUsername(),
            $comment->getText(),
            $comment->getStars(),
            $comment->getCreatedAt(),
        );
    }
    public function updateCommentById(int $id, UpdateCommentRequest $request)
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment) {
            return null;
        }

        $stars = $request->getStars();
        $text = $request->getText();
        $username = $request->getUsername();

        if (isset($stars)) {
            $comment->setStars($stars);
        }

        if (isset($text)) {
            $comment->setText($text);
        }

        if (isset($username)) {
            $comment->setUsername($username);
        }

        $comment->setUpdatedAt(new \DateTimeImmutable());

        $this->em->persist($comment);

        $this->em->flush();

        return new CommentListItem(
            $comment->getId(),
            $comment->getUsername(),
            $comment->getText(),
            $comment->getStars(),
            $comment->getCreatedAt(),
        );
    }
}
