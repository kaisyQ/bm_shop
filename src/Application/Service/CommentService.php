<?php declare(strict_types=1);

namespace App\Application\Service;

use App\Presentation\Response\CommentListItem;
use App\Presentation\Request\CreateCommentRequest;
use App\Presentation\Request\UpdateCommentRequest;
use App\Domain\Entity\Comment;
use App\Infrastructure\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CommentService
{
    public function __construct(
        private CommentRepository         $commentRepository,
        private EntityManagerInterface    $em,
    ) {}

    public function getComments()
    {
        $comments = $this->commentRepository->findAll();

        return $comments;
    }

    public function getCommentById($id): ?CommentListItem
    {
        $comment = $this->commentRepository->find($id);

        if (!$comment) {
            return null;
        }

        return $comment;
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

            // Временное решение на время пока в проект не прокину Monad-ы
            throw new \Exception('Ошибка удаления'); 
        }


        return $id;
    }

    public function createComment(CreateCommentRequest $request)
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
        catch (\Exception $e)
        {
             // Временное решение на время пока в проект не прокину Monad-ы
             throw new \Exception('Ошибка Создания'); 
        }

        return $comment;
    }


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
        
            // Временное решение на время пока в проект не прокину Monad-ы
            throw new \Exception('Ошибка обновления'); 
        }

        return $comment;
    }
}
