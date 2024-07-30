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
        'user_id',
        'likes',
        'candidate_id',
        'dislikes'
    ];

    protected $with = [
        'user',
        'candidate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}