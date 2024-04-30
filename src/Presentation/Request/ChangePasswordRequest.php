<?php declare(strict_types=1);

namespace App\Presentation\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class ChangePasswordRequest
{

    #[Assert\NotBlank]
    public string $oldPassword;

    #[Assert\NotBlank]
    public string $newPassword;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    public function __construct(string $oldPassword, string $newPassword, string $email)
    {
        $this->email = $email;
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
    }
}