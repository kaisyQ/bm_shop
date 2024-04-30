<?php declare(strict_types=1);

namespace App\Presentation\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class ConfirmRegisterRequest
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
    #[Assert\NotBlank]
    public string $password;
    #[Assert\NotBlank]
    public string $username;
    #[Assert\NotBlank]
    public string $code;

    public function __construct(string $email, string $password, string $username, string $code)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->code = $code;
    }
}