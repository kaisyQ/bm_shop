<?php
declare(strict_types=1);
namespace App\Controller;

use App\Dto\CommentListItem;
use App\Dto\CreateCommentRequest;
use App\Dto\UpdateCommentRequest;
use App\Exception\DatabaseException;
use App\Exception\ValidateException;
use App\Service\CommentService;
use App\Dto\CommentList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route(path: "api/v1/comments", name: "comments")]
final class CommentController extends AbstractController
{

    public function __construct(private readonly CommentService $commentService) {}

    #[Route(path: "/", name: "comment_index", methods: ["GET"])]
    #[OA\Response(
        response: 200,
        description: 'Return all comments',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: CommentList::class))
        )
    )]
    public function index(): JsonResponse
    {
        return $this->json($this->commentService->getComments());
    }


    #[Route(path: "/{id}", name: "comment_show", methods: ["GET"])]
    #[OA\Response(
        response: 200,
        description: 'Return one comment',
        content: new OA\JsonContent(
            ref: new Model(type: CommentListItem::class)
        )
    )]
    public function show(int $id): JsonResponse
    {
        return $this->json($this->commentService->getCommentById($id));
    }


    /**
     * @throws DatabaseException
     */
    #[Route(path: "/create", name: "comment_store", methods: ["POST"])]
    #[OA\Response(
        response: 200,
        description: 'Return created comment',
        content: new OA\JsonContent(
            ref: new Model(type: CommentListItem::class)
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(type: CreateCommentRequest::class)
        )
    )]

    public function store(#[MapRequestPayload] CreateCommentRequest $request): Response
    {
        return $this->json($this->commentService->createComment($request));
    }

    /**
     * @throws DatabaseException
     * @throws ValidateException
     */
    #[Route(path: "/update/{id}", name: "comment_update", methods: ["PUT"])]
    #[OA\Response(
        response: 200,
        description: 'Return updated comment',
        content: new OA\JsonContent(
            ref: new Model(type: CommentListItem::class)
        )
    )]
    #[OA\RequestBody(
        content: new OA\JsonContent(
            ref: new Model(type: UpdateCommentRequest::class)
        )
    )]

    public function update(#[MapRequestPayload] UpdateCommentRequest $request, int $id): Response
    {
        return $this->json($this->commentService->updateCommentById($id, $request));
    }

    /**
     * @throws DatabaseException
     */
    #[Route(path: "/delete/{id}", name: "comment_destroy", methods: ['DELETE'])]
    #[OA\Response(
        response: 200,
        description: 'Return deleted comment id',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'id', type: 'string')
            ],
            type: 'object'
        )
    )]
    public function destroy(int $id): JsonResponse
    {
        return $this->json($this->commentService->deleteCommentById($id));
    }
}
