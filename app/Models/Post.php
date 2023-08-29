<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = [
        'user_id',
        'title',
        'post_image',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPostImageAttribute($value)
    {
       return $this->attributes['post_image'] = asset($value);
    }

    public function getPostImageAttribute($value)
    {
        return $this->attributes['post_image'] = asset($value);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }
}
