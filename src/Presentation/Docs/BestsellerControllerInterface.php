<?php

declare(strict_types=1);

namespace App\Presentation\Docs;

use OpenApi\Annotations as OA;

use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @OA\Info(title="Rest API server for bmfurniture", version="0.1")
*/
interface BestsellerControllerInterface {
  
    /**
     * @OA\Get(
     *   tags={"Bestsellers"},
     *   path="/api/v1/bestsellers/",
     *   summary="Get all bestsellers",
     *   description="Method returns all bestsellers",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/BestsellerDetail")
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
}