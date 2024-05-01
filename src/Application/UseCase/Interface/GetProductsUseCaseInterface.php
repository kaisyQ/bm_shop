<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

use App\Presentation\Dto\GetProductsDto;

/**
 * Get all filtered products UseCase
 */
interface GetProductsUseCaseInterface
{
    public function execute(GetProductsDto $data);
}