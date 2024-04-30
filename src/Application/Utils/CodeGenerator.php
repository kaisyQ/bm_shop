<?php declare(strict_types=1);

namespace App\Application\Utils;

/**
 * Register code generator
 */
trait CodeGenerator
{
    const int CODE_LENGTH = 6;

    const int START = 6;
    public function generateCode(): string
    {
        return substr(md5(uniqid((string)rand(), true)), self::START, self::CODE_LENGTH);
    }
}