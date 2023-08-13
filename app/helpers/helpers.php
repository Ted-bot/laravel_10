<?php

use Illuminate\Support\Str;

function str_limit(string $post, int $limit, string $end)
{
    return Str::limit($post, $limit, $end);
}
