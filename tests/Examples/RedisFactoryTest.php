<?php

declare(strict_types=1);

namespace AndySnell\Tests\Talks\RedisDataStructures;

use AndySnell\Talks\RedisDataStructures\Examples\RedisFactory;
use PHPUnit\Framework\TestCase;
use Redis;

class RedisFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function make_returns_connected_Redis_instance(): void
    {
        $factory = new RedisFactory();
        $redis = $factory->make();

        self::assertInstanceOf(Redis::class, $redis);
        self::assertTrue($redis->ping());
    }
}
