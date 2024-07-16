<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
