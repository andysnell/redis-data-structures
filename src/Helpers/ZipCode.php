<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Helpers;

use Stringable;

class ZipCode implements Stringable
{
    private string $zip_code;

    public function __construct(string $zip_code)
    {
        $zip_code = \str_replace('-', '', $zip_code);
        if (\strlen($zip_code) === 5) {
            $zip_code .= '0000';
        }

        if (!\preg_match("/^\d{9}$/", $zip_code)) {
            throw new \InvalidArgumentException();
        }

        $this->zip_code = \vsprintf('%s-%s', [
            \substr($zip_code, 0, 5),
            \substr($zip_code, -4, 4),
        ]);
    }

    public function getFirst5(): string
    {
        return \substr($this->zip_code, 0, 5);
    }

    public function getPlus4(): string
    {
        return \substr($this->zip_code, -4, 4);
    }

    public function __toString(): string
    {
        return $this->zip_code;
    }
}
