<?php

declare(strict_types=1);

namespace App\Presentation\Docs;

use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;


interface CategoryControllerInterface {
  
    /**
     * @OA\Get(
     *   tags={"Categories"},
     *   path="/api/v1/categories/",
     *   summary="Get all categories",
     *   description="Method returns all categories",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/CategoryDetail")
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Not found",
     *   )
     * )
     */
    public function index(): JsonResponse;


    /**
     * @OA\Delete(
     *   tags={"Categories"},
     *   path="/api/v1/categories/{id}",
     *   summary="Remove category by ID",
     *   description="Remove category by ID",
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
     *         property="message", 
     *         type="string",
     *         example="Category was succesfully deleted!"
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

    public function destroy(int $id): JsonResponse;
}