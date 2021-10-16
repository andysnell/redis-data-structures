<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Examples;

use AndySnell\Talks\RedisDataStructures\Helpers\ZipCode;

class ZipCodeBanList
{
    private \Redis $redis;

    public function __construct(RedisFactory $redis_factory = null)
    {
        $this->redis = ($redis_factory ?? new RedisFactory())->make();
    }

    public function add(ZipCode $zip_code): bool
    {
        return (bool)$this->redis->setBit($zip_code->getFirst5(), (int)$zip_code->getPlus4(), 1);
    }

    public function remove(ZipCode $zip_code): bool
    {
        return (bool)$this->redis->setBit($zip_code->getFirst5(), (int)$zip_code->getPlus4(), 0);
    }

    public function check(ZipCode $zip_code): bool
    {
        return (bool)$this->redis->getBit($zip_code->getFirst5(), (int)$zip_code->getPlus4());
    }
}
