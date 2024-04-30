<?php declare(strict_types=1);

namespace App\Infrastructure\Cache;

use Predis\Client;

final class Cache
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => 'localhost',
            'port'   => 6379,
        ]);
    }

    public function get($key)
    {
        return json_decode($this->client->get($key));
    }

    public function set($key, $value, $ttl = null): void
    {
        if ($ttl) {
            $this->client->set($key, json_encode($value), 'EX', $ttl);
        } else {
            $this->client->set($key, json_encode($value));
        }
    }

    public function remove($key): void
    {
        $this->client->del($key);
    }
}
