<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'education', 'experience', 'position_id', 'email', 'city_id', 'state_id', 'gender', 'phone', 'party_id', 'electoral_affiliation', 'electoral_number', 'status', 'user_id'];

    public function parties()
    {
        return $this->belongsTo(Party::class);
    }

    protected $with = [
        'user',
        'party',
        'position',
        'state',
        'city',
        'currentPosition'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function currentPosition()
    {
        return $this->belongsTo(CurrentPosition::class);
    }
}
