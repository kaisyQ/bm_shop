<?php declare(strict_types=1);

namespace App\Presentation\Docs\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="CommentDetail",
 *   type="object",
 *   @OA\Property(
 *     property="id",
 *     type="integer",
 *     example="1",
 *   ),
 *   @OA\Property(
 *     property="username",
 *     type="string",
 *     example="Megan from Scarborough",
 *   ),
 *   @OA\Property(
 *     property="text",
 *     type="string",
 *     example="Everything was great and they even carried the couch up my stairs for me. Love it.",
 *   ),
 *   @OA\Property(
 *     property="stars",
 *     type="integer",
 *     example="5",
 *   ),
 *   @OA\Property(
 *     property="createdAt",
 *     type="string",
 *     example="09.03.2024",
 *   )
 * )
 */

interface CommentDetailInterface {}