<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class CommentRelpy extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'author',
        'email',
        'body',
        'is_active'
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

}
