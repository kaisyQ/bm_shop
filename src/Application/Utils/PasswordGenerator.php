<?php

namespace App\Application\Utils;

trait PasswordGenerator
{
    public function generatePassword(string $password): string
    {
        return hash_hmac('sha256', $password, 'bababa');
    }
}