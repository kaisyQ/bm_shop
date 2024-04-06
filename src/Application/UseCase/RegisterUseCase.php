<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Domain\Entity\Admin;
use App\Infrastructure\Repository\AdminRepository;
use App\Presenstation\Request\RegisterRequest;

final class RegisterUseCase 
{
    public function __construct(
        private readonly AdminRepository $adminRepository
    ){}

    public function execute(RegisterRequest $data) 
    {
        $user = new Admin();
    }
}