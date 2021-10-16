<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Examples;

use AndySnell\Talks\RedisDataStructures\Helpers\RateLimitExceeded;
use Redis;

class RateLimiter
{
    public function __construct(private Redis $redis) {}

    public function check(string $request_source_id, $requests_per_minute = 120): void
    {
        $key = "ratelimit:" . $request_source_id;

        $pipe = $this->redis->multi(Redis::PIPELINE);
        $pipe->zAdd($key, time(), bin2hex(\random_bytes(16)));
        $pipe->expire($key, 60);
        $pipe->zRemRangeByScore($key, 0, time() - 60);
        $pipe->zCard($key);
        $pipe_results = $pipe->exec(); // [1, true, 0, 1]
        if ($pipe_results[3] > $requests_per_minute) {
            throw new RateLimitExceeded();
        }
    }
}
