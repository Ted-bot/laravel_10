<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'author',
        'email',
        'body',
        'photo',
        'is_active'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'post_id');
    }

}
