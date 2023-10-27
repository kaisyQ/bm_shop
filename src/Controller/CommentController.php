<?php

namespace App\Controller;

use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(name: "comments", path: "api/v1/comments")]
class CommentController extends AbstractController
{

    public function __construct(
        private CommentService $commentService,
    ) {
    }

    #[Route(path: "/", name: "comment_index", methods: ["GET"])]
    public function index(Request $request): Response
    {
        return $this->json($this->commentService->getComments());
    }


    #[Route(path: "/{id}", name: "comment_show", methods: ["GET"])]
    public function show(int $id)
    {
        return $this->json(["id" => $id]);
    }

    #[Route(path: "/create", name: "comment_store", methods: ["POST"])]
    public function store(Request $request): Response
    {
        return $this->json(["id" => 1]);
    }

    #[Route(path: "/update/{id}", name: "comment_update", methods: ["PUT"])]
    public function update(Request $request, int $id): Response
    {
        return $this->json(["id" => $id]);
    }

    #[Route(path: "/delete/{id}", name: "comment_destroy", methods: ['DELETE'])]
    public function destroy(Request $request, int $id): Response
    {
        return $this->json(["id" => $id]);
    }
}
