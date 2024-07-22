<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'image_url',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}