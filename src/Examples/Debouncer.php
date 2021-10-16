<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Examples;

class Debouncer
{
    private const DEFAULT_TTL = 30;

    private \Redis $redis;

    public function __construct(RedisFactory $redis_factory = null)
    {
        $this->redis = ($redis_factory ?? new RedisFactory())->make();
    }

    public function run(string $debounce_key, callable $callable): void
    {
        if($this->redis->exists($debounce_key)){
            return;
        }

        $this->redis->set($debounce_key, 1, self::DEFAULT_TTL);
        $callable();
    }
}
