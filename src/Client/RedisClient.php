<?php

namespace Project\Client;

use Predis\Client;

class RedisClient implements CacheClientInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => 'redis',
            'port'   => '6379',
        ]);
    }

    public function getByKey(string $key): string
    {
       return $this->client->get($key);
    }

    public function save(string $key, array $values)
    {
        $this->client->set($key, json_encode($values));
    }

    public function checkAvailability(): bool
    {
       if ($this->client->ping()) {
           return true;
       }

       return false;
    }
}