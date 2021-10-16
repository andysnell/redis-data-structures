<?php

declare(strict_types=1);

namespace AndySnell\Test\Talks\RedisDataStructures\Helpers;

use AndySnell\Talks\RedisDataStructures\Helpers\ZipCode;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ZipCodeTest extends TestCase
{
    /**
     * @test
     * @testWith ["44221", "44221", "0000"]
     *           ["44221-4534", "44221", "4534"]
     *           ["442214534", "44221", "4534"]
     */
    public function ZipCode_is_value_object_for_zip_code(string $input, string $first5, string $plus4): void
    {
        $zip_code = new ZipCode($input);

        self::assertSame($first5, $zip_code->getFirst5());
        self::assertSame($plus4, $zip_code->getPlus4());
        self::assertSame($first5 . '-' . $plus4, (string)$zip_code);
    }

    /**
     * @test
     * @testWith ["0000"]
     *           ["4534"]
     *           ["4422145"]
     *           ["44221--534"]
     *           ["4422145034"]
     */
    public function ZipCode_throws_exception_when_input_is_invalid(string $input): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ZipCode($input);
    }
}
