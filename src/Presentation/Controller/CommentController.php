<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Presenstation\Request\CreateCommentRequest;
use App\Presenstation\Request\UpdateCommentRequest;
use App\Application\Service\CommentService;
use App\Presentation\Docs\CommentControllerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "api/v1/comments", name: "comments")]
final class CommentController extends AbstractController implements CommentControllerInterface
{

    public function __construct(private readonly CommentService $commentService) {}

    #[Route(path: "/", name: "comment_index", methods: ["GET"])]
    public function index(): JsonResponse
    {
        return $this->json($this->commentService->getComments());
    }


    #[Route(path: "/{id}", name: "comment_show", methods: ["GET"])]
    public function show(int $id): JsonResponse
    {
        return $this->json($this->commentService->getCommentById($id));
    }


    #[Route(path: "/create", name: "comment_store", methods: ["POST"])]
    public function store(#[MapRequestPayload] CreateCommentRequest $request): JsonResponse
    {
        return $this->json($this->commentService->createComment($request));
    }

    #[Route(path: "/update/{id}", name: "comment_update", methods: ["PUT"])]
    public function update(#[MapRequestPayload] UpdateCommentRequest $request, int $id): JsonResponse
    {
        return $this->json($this->commentService->updateCommentById($id, $request));
    }

    #[Route(path: "/delete/{id}", name: "comment_destroy", methods: ['DELETE'])]
    public function destroy(int $id): JsonResponse
    {
        return $this->json($this->commentService->deleteCommentById($id));
    }
}
