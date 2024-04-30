<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

/**
 * UseCase for refreshing customer password
 */
interface RefreshPasswordUseCaseInterface
{
    public function execute(string $email);
}