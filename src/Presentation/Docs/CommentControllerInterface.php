<?php declare(strict_types=1);


namespace App\Presentation\Docs;

use Symfony\Component\HttpFoundation\JsonResponse;

use OpenApi\Annotations as OA;
use App\Presenstation\Dto\CreateCommentRequest;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Presenstation\Dto\UpdateCommentRequest;

interface CommentControllerInterface {
    
    /**
     * @OA\Get(
     *   tags={"Comments"},
     *   path="/api/v1/comments/",
     *   summary="Get all comments",
     *   description="Returns all comments",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/CommentDetail")
     *       ),
     *     )
     *   )
     * )
     */
    public function index(): JsonResponse;

    /**
     * @OA\Get(
     *   tags={"Comments"},
     *   path="/api/v1/comments/{id}",
     *   summary="Get one by ID",
     *   description="Method returns one comment by its ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200, 
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data", 
     *         ref="#/components/schemas/CommentDetail"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=401, 
     *     description="Unauthorized"
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Not Found"
     *   )
     * )
     */

    public function show(int $id): JsonResponse;

    /**
     * @OA\Post(
     *   tags={"Comments"},
     *   path="/api/v1/comments/create",
     *   summary="Create comment",
     *   description="Create comment using request body params",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="username", 
     *         type="string",
     *         example="Megan from Scarborough",
     *       ),
     *       @OA\Property(
     *         property="text",
     *         type="string",
     *         example="Everything was great and they even carried the couch up my stairs for me. Love it.",
     *       ),
     *       @OA\Property(
     *         property="stars",
     *         type="integer",
     *         example="5",
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data", 
     *         ref="#/components/schemas/CommentDetail"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=401, 
     *     description="Unauthorized"
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Not Found"
     *   )
     * )
     */

    public function store(#[MapRequestPayload] CreateCommentRequest $request): JsonResponse;

        

    /**
     * @OA\Put(
     *   tags={"Comments"},
     *   path="/api/v1/comments/update",
     *   summary="Update comment",
     *   description="Update comment using request body params",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="username", 
     *         type="string",
     *         example="Megan from Scarborough",
     *         nullable=true
     *       ),
     *       @OA\Property(
     *         property="text",
     *         type="string",
     *         example="Everything was great and they even carried the couch up my stairs for me. Love it.",
     *         nullable=true
     *       ),
     *       @OA\Property(
     *         property="stars",
     *         type="integer",
     *         example="5",
     *         nullable=true
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data", 
     *         ref="#/components/schemas/CommentDetail"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=401, 
     *     description="Unauthorized"
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Not Found"
     *   )
     * )
     */
    public function update(#[MapRequestPayload] UpdateCommentRequest $request, int $id): JsonResponse;

    /**
     * @OA\Delete(
     *   tags={"Comments"},
     *   path="/api/v1/comments/delete/{id}",
     *   summary="Delete comment",
     *   description="Delete comment using ID from query params. Returns removed comment ID",
     *   @OA\Parameter(
     *     name="id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200, 
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="id", 
     *         type="integer",
     *         example="1",
     *         nullable=true
     *       )
     *     )
     *     
     *   ),
     *   @OA\Response(
     *     response=401, 
     *     description="Unauthorized"
     *   ),
     *   @OA\Response(
     *     response=404, 
     *     description="Not Found"
     *   )
     * )
     */
    public function destroy(int $id): JsonResponse;
}
