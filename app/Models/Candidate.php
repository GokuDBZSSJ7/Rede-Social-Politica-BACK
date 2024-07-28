<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'education', 'experience', 'position_id', 'email', 'city_id', 'state_id', 'gender', 'phone', 'party_id', 'electoral_affiliation', 'electoral_number', 'status'];

    public function parties() {
        return $this->belongsTo(Party::class);
    }
}
