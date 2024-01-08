<?php

namespace App\Test;

use App\Dto\UpdateCommentRequest;
use App\Entity\Comment;
use App\Exception\ValidateException;
use App\Repository\CommentRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Service\CommentService;
use App\Dto\CommentList;
use App\Dto\CommentListItem;
use App\Dto\CreateCommentRequest;

class CommentServiceTest extends TestCase
{
    /**
     * @throws ValidateException
     */
    public function testGetComments()
    {
        $commentRepository = $this->createMock(CommentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);


        $date = new DateTimeImmutable();

        $commentRepository->expects($this->once())
            ->method("findAll")
            ->willReturn(
                [
                    (new Comment)
                        ->setId(1)->setUsername("username")->setText("comment text")
                        ->setStars(5)->setCreatedAt($date)->setUpdatedAt($date),

                    (new Comment)
                        ->setId(2)->setUsername("username1")->setText("comment text1")
                        ->setStars(4)->setCreatedAt($date)->setUpdatedAt($date),

                    (new Comment)
                        ->setId(3)->setUsername("username2")->setText("comment text2")
                        ->setStars(3)->setCreatedAt($date)->setUpdatedAt($date),
                ]
            );
        $service = new CommentService($commentRepository, $em);

        $expected = new CommentList(
            [
                new CommentListItem(1, "username", "comment text", 5, $date),
                new CommentListItem(2, "username1", "comment text1", 4, $date),
                new CommentListItem(3, "username2", "comment text2", 3, $date),

            ]
        );

        $this->assertEquals($expected, $service->getComments());
    }

    public function testGetCommentById()
    {
        $commentRepository = $this->createMock(CommentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);

        $date = new DateTimeImmutable();

        $commentRepository->expects($this->exactly(2))
            ->method("find")
            ->withConsecutive(
                [1],
                [2],
            )
            ->willReturnOnConsecutiveCalls(
                (new Comment)
                    ->setId(1)->setUsername("username")->setText("comment text")
                    ->setStars(5)->setCreatedAt($date)->setUpdatedAt($date),
                null
            );


        $service = new CommentService($commentRepository, $em);

        $expected1 = new CommentListItem(1, "username", "comment text", 5, $date);

        $this->assertEquals($expected1, $service->getCommentById(1));
        $this->assertNull($service->getCommentById(2));
    }

    public function testCreateComment()
    {
        $commentRepository = $this->createMock(CommentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);


        $date = new DateTimeImmutable();


        $em->expects($this->once())->method('persist')
            ->willReturnCallback(fn (Comment $comment) => $comment->setId(1)->setUpdatedAt($date)->setCreatedAt($date));


        $request = new CreateCommentRequest("user", 'text', 5);

        $service = new CommentService($commentRepository, $em);

        $this->assertEquals((new CommentListItem(1, 'user', 'text', 5, $date)), $service->createComment($request));
    }

    public function testUpdateComment()
    {

        $commentRepository = $this->createMock(CommentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);

        $date = new DateTimeImmutable();

        $comment = (new Comment())
            ->setId(1)->setText('text')->setUsername('user')
            ->setStars(3)->setCreatedAt($date)->setUpdatedAt($date);

        $commentRepository
            ->expects($this->once())->method('find')->withConsecutive([1], [1], [1], [1], [1], [1], [1])
            ->willReturnOnConsecutiveCalls(
                $comment,
                $comment,
                $comment,
                $comment,
                $comment,
                $comment,
                $comment,
            );

        $requests = [
            new UpdateCommentRequest('user1', 'text1', 5),
            new UpdateCommentRequest(username: 'user1', text: 'text1'),
            new UpdateCommentRequest(text: 'text1', stars: 3),
            new UpdateCommentRequest(username: 'user1', stars: 1),
            new UpdateCommentRequest(username: 'user1'),
            new UpdateCommentRequest(text: 'text1'),
            new UpdateCommentRequest(stars: 2),
        ];


        $newDate = new DateTimeImmutable();

        $em
            ->expects($this->once())->method('persist')->willReturnCallback(
                fn (Comment $comment) => $comment->setUpdatedAt($newDate)
            );

        $service = new CommentService($commentRepository, $em);

        $expected = [
            new CommentListItem(1, 'user1', 'text1', 5, $date),
            new CommentListItem(1, 'user', 'text1', 3, $date),
            new CommentListItem(1, 'user1', 'text', 1, $date),
            new CommentListItem(1, 'user1', 'text', 5, $date),
            new CommentListItem(1, 'user', 'text1', 5, $date),
            new CommentListItem(1, 'user', 'text', 2, $date),
        ];

        $this->assertEquals($expected[0], $service->updateCommentById(1, $requests[0]));
    }

    public function testDeleteComment()
    {
        $commentRepository = $this->createMock(CommentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $date = new DateTimeImmutable();


        $commentRepository->expects($this->exactly(1))->method('find')->withConsecutive([1])->willReturn(
            (new Comment())
                ->setId(1)->setText('text')->setUsername('user')
                ->setStars(3)->setCreatedAt($date)->setUpdatedAt($date)
        );

        $service = new CommentService($commentRepository, $em);

        $this->assertEquals(1, $service->deleteCommentById(1));
    }
}
