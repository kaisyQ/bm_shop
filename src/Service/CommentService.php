<?php

namespace App\Service;

use App\Constants\ExceptionCode;
use App\Dto\CommentList;
use App\Dto\CommentListItem;
use App\Dto\CreateCommentRequest;
use App\Dto\UpdateCommentRequest;
use App\Entity\Comment;
use App\Exception\DatabaseCreateException;
use App\Exception\DatabaseDeleteException;
use App\Exception\DatabaseUpdateException;
use App\Mapper\CommentItemResponseMapper;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Constants\ExceptionInfo;

final class CommentService
{
    public function __construct(
        private readonly CommentRepository $commentRepository,
        private readonly EntityManagerInterface $em,
        private readonly CommentItemResponseMapper $commentMapper,
    ) {
    }

    public function getComments(): CommentList
    {
        $comments = $this->commentRepository->findAll();

        return $this->commentMapper->mapFromCommentArray($comments);
    }

    public function getCommentById($id): ?CommentListItem
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment) {
            return null;
        }

        return $this->commentMapper->mapFromComment($comment);
    }

    public function deleteCommentById(int $id): ?int
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment)
        {
            return null;
        }

        try
        {
            $this->em->remove($comment);

            $this->em->flush();
        }
        catch (\Exception $exp)
        {
            throw new DatabaseDeleteException(
                ExceptionInfo::getMessageByKey(ExceptionCode::DELETE_DATABASE_ERROR),
                ExceptionCode::DELETE_DATABASE_ERROR
            );
        }


        return $id;
    }

    /**
     * @throws DatabaseCreateException
     */
    public function createComment(CreateCommentRequest $request): CommentListItem
    {
        try
        {
            $comment = new Comment();

            $comment->setUsername($request->getUsername());
            $comment->setText($request->getText());
            $comment->setStars($request->getStars());

            $this->em->persist($comment);
            $this->em->flush();

        }
        catch (\Exception $exp)
        {
            throw new DatabaseCreateException(
                ExceptionInfo::getMessageByKey(ExceptionCode::CREATE_DATABASE_ERROR),
                ExceptionCode::CREATE_DATABASE_ERROR
            );
        }

        return $this->commentMapper->mapFromComment($comment);
    }

    /**
     * @throws DatabaseUpdateException
     */
    public function updateCommentById(int $id, UpdateCommentRequest $request): ?CommentListItem
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment)
        {
            return null;
        }

        $stars = $request->getStars();
        $text = $request->getText();
        $username = $request->getUsername();

        if (isset($stars))
        {
            $comment->setStars($stars);
        }

        if (isset($text))
        {
            $comment->setText($text);
        }

        if (isset($username))
        {
            $comment->setUsername($username);
        }

        $comment->setUpdatedAt(new \DateTimeImmutable());

        try
        {

            $this->em->persist($comment);

            $this->em->flush();

        }
        catch (\Exception $exp)
        {
            throw new DatabaseUpdateException(
                ExceptionInfo::getMessageByKey(ExceptionCode::UPDATE_DATABASE_ERROR),
                ExceptionCode::UPDATE_DATABASE_ERROR
            );
        }

        return $this->commentMapper->mapFromComment($comment);
    }
}
