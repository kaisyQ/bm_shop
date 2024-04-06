<?php declare(strict_types=1);

namespace App\Presenstation\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class RegisterRequest
{
    #[Assert\NotBlank]
    #[Assert\Email()]
    public readonly string $email;
    #[Assert\NotBlank]
    public readonly string $password;
    #[Assert\NotBlank]
    public readonly string $username;

    public function __construct(string $email, string $password, string $username)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }
}