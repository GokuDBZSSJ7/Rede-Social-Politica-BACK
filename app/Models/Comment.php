<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['attachment', 'text', 'likes', 'dislikes', 'post_id', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function post()
    {
        return $this->hasOne(Post::class, 'post_id');
    }
}