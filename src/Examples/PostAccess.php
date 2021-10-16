<?php

declare(strict_types=1);

namespace AndySnell\Talks\RedisDataStructures\Examples;

use Redis;

class PostAccess
{
    public function __construct(private Redis $redis) {}

    public function add(int $user_id, int $post_id): bool
    {
        $personal_key = "user:{$user_id}:posts";
        return (bool)$this->redis->sAdd($personal_key, $post_id);
    }

    public function check(int $user_id, int $team_id, int $post_id): bool
    {
        $personal_key = "user:{$user_id}:posts";
        $team_key = "team:{$team_id}:posts";
        $union_key = "temp:allposts:{$user_id}";
        $pipe = $this->redis->multi();
        $pipe->sInterStore($union_key, $personal_key, $team_key);
        $pipe->sIsMember($union_key, $post_id);
        $pipe->del($union_key);
        $result = $pipe->exec();
        return (bool)$result[1];
    }
}
