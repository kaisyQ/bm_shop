<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

/**
 * Use case for customer logout
 */
interface LogoutUseCaseInterface
{
    public function execute(string $session);
}