<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

use App\Presentation\Request\ChangePasswordRequest;

/**
 * UseCase for changing customer password
 */
interface ChangePasswordUseCaseInterface
{
    public function execute(ChangePasswordRequest $data): void;
}