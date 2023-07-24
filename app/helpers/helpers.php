<?php

use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Session;

function str_limit(string $post, int $limit, string $end)
{
    return Str::limit($post, $limit, $end);
}
