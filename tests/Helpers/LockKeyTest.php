<?php

declare(strict_types=1);

namespace AndySnell\Tests\Talks\RedisDataStructures\Helpers;

use AndySnell\Talks\RedisDataStructures\Helpers\LockKey;
use LogicException;
use PHPUnit\Framework\TestCase;

class LockKeyTest extends TestCase
{
    /**
     * @test
     */
    public function LockKey_can_be_cast_to_string(): void
    {
        $raw_key = 'foo bar baz';
        $key = new LockKey($raw_key);
        self::assertSame($raw_key, (string)$key);
    }

    /**
     * @test
     */
    public function LockKey_defaults_to_random_hex_string(): void
    {
        self::assertMatchesRegularExpression('/^[a-zA-Z0-9]{32}$/', (string)new LockKey());
    }

    /**
     * @test
     */
    public function LockKey_throws_exception_when_passed_empty_string(): void
    {
        $this->expectException(LogicException::class);
        new LockKey('');
    }
}
