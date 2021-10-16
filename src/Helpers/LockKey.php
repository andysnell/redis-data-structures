<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Helpers;

use LogicException;
use Stringable;

class LockKey implements Stringable
{
    private string $key;

    public function __construct(string $key = null)
    {
        if($key === ''){
            throw new LogicException();
        }

        $this->key = $key ?? \bin2hex(\random_bytes(16));
    }

    public function __toString(): string
    {
        return $this->key;
    }
}
