<?php

declare(strict_types=1);

namespace App\Presentation\Docs\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema (
 *   schema="BestsellerDetail",
 *   type="object",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1"
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Example Couch"
 *   ),
 *   @OA\Property(
 *     property="slug",
 *     type="string",
 *     example="example_couch",
 *   ),
 *   @OA\Property(
 *     property="price",
 *     type="integer",
 *     example="1200"
 *   ),
 *   @OA\Property(
 *     property="discountPrice",
 *     type="integer",
 *     example="1000",
 *   )
 * )
 */
interface BestsellerDetailInterface {}