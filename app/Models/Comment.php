<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentReply;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'author',
        'email',
        'body',
        'photo',
        'is_active'
    ];

    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
