<?php

namespace App\Adapter\Interface;

interface CacheAdapterInterface
{
    public function get(string $key): mixed;

    public function set(string $key, mixed $value): void;
}