<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

/**
 *
 * Get product by slug UseCase
 */
interface GetProductBySlugInterface
{
    public function execute(string $slug);
}