<?php

namespace Project\Client;

interface CacheClientInterface
{
    public function getByKey(string $key): string;
    public function save(string $key, array $values): void;
    public function checkAvailability(): bool;
}