<?php

namespace App\Test;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Service\CommentService;
use App\Dto\CommentList;
use App\Dto\CommentListItem;


class CommentServiceTest extends TestCase {
    public function testGetComments () 
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
        $service = new CommentService($commentRepository , $em);

        $expected = new CommentList(
            [
                new CommentListItem(1, "username", "comment text", 5, $date),
                new CommentListItem(2, "username1", "comment text1", 4, $date),
                new CommentListItem(3, "username2", "comment text2", 3, $date),

            ]
        );

        $this->assertEquals($expected, $service->getComments());
    }

    public function testGetCommentById() {
        $commentRepository = $this->createMock(CommentRepository::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $date = new DateTimeImmutable();

        $commentRepository->expects($this->exactly(2))
            ->method("find")
            ->withConsecutive(
                [1], [2]
            )
            ->willReturnOnConsecutiveCalls(
                (new Comment)
                    ->setId(1)->setUsername("username")->setText("comment text")
                    ->setStars(5)->setCreatedAt($date)->setUpdatedAt($date),
                null
            )
        ;


        $service = new CommentService($commentRepository , $em);

        $expected1 = new CommentListItem(1, "username", "comment text", 5, $date);

        $this->assertEquals($expected1, $service->getCommentById(1));
        $this->assertNull($service->getCommentById(2));
    }

    
}