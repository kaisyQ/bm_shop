<?php

namespace App\Controller;

use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(name: "comments", path: "api/v1/comments")]
class CommentController extends AbstractController {

    public function __construct(
        private CommentService $commentService,
    ) {}

    #[Route(path: "/", name: "index", methods: [])]
    public function index(Request $request) : Response {
        return $this->json($this->commentService->getComments());
    }

    public function show() {
    }
    public function store(Request $request) {
    }
    public function update(Request $request, $id) { 
    }
    public function destroy(Request $request, $id) {
    }
}