<?php declare(strict_types=1);

namespace App\Presentation\Docs\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="CategoryDetail",
 *   type="object",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1",
 *   ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     example="Couch",
 *   ),
 *   @OA\Property(
 *     property="slug",
 *     type="string",
 *     example="couch",
 *   )
 * )
 */

interface CategoryDetailInterface {}