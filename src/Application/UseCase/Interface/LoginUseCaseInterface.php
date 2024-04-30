<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

use App\Presentation\Request\LoginRequest;

/**
 * UseCase for customers sign in
 */
interface LoginUseCaseInterface
{
    public function execute(LoginRequest $data): array;
}