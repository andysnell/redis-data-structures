<?php

declare(strict_types=1);

namespace AndySnell\Tests\Talks\RedisDataStructures\Structures;

use AndySnell\Talks\RedisDataStructures\Examples\RedisFactory;
use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    /**
     * @test
     */
    public function set_can_have_a_ttl(): void
    {
        $redis = (new RedisFactory())->make();
        $redis->setex('foo', 1, 'hello, world');
        self::assertSame('hello, world', $redis->get('foo'));

        \sleep(1);

        self::assertFalse($redis->get('get'));
    }
}
