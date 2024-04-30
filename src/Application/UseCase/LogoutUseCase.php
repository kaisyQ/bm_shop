<?php declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\UseCase\Interface\LogoutUseCaseInterface;
use App\Infrastructure\Cache\Cache;

final class LogoutUseCase implements LogoutUseCaseInterface
{
    private Cache $cache;
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function execute(string $session): void
    {
        $this->cache->remove($session);
    }
}