<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Examples;

use AndySnell\Talks\RedisDataStructures\Helpers\LockKey;

class SimpleLock
{
    private const DEFAULT_TTL = 30;

    private \Redis $redis;

    public function __construct(RedisFactory $redis_factory = null)
    {
        $this->redis = ($redis_factory ?? new RedisFactory())->make();
    }

    public function lock(string $resource, LockKey $key, int $ttl = self::DEFAULT_TTL): bool
    {
        return $this->redis->set("locks.{$resource}", (string)$key, [
            'EX' => $ttl,
            'NX',
        ]);
    }

    public function unlock(string $resource = '', LockKey $key = null): bool
    {
        $lock = $this->redis->get($resource);
        if ($lock !== (string)$key) {
            return false;
        }

        if ($lock) {
            $this->redis->del($resource);
        }

        return true;

    }
}
