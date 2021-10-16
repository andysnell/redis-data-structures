<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Examples;

use Redis;

class RedisFactory
{
    public function make(): Redis
    {
        $redis = new Redis();
        $redis->connect('redis-server');
        return $redis;
    }
}
