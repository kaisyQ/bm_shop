<?php
declare(strict_types=1);

namespace App\Adapter;

use App\Adapter\Interface\CacheAdapterInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

final readonly class CacheAdapter implements CacheAdapterInterface
{
    private \Predis\ClientInterface $client;
    public function __construct()
    {
        $this->client = RedisAdapter::createConnection(
            $_ENV("REDIS_DSN"),
        );
    }

    /**
     * @throws \RedisException
     */
    public function get(string $key): mixed
    {
        return $this->client->get($key);
    }

    /**
     * @throws \RedisException
     */
    public function set(string $key, mixed $value): void
    {
        $this->client->set($key, $value);
    }
}