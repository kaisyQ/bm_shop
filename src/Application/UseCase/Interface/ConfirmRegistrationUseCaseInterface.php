<?php declare(strict_types=1);

namespace App\Application\UseCase\Interface;

use App\Presentation\Request\ConfirmRegisterRequest;

/**
 *
 * Use case for confirming customer registration
 */
interface ConfirmRegistrationUseCaseInterface
{
    public function execute(ConfirmRegisterRequest $data);
}