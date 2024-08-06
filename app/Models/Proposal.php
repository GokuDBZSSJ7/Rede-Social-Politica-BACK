<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    private $fillable = [
        'title',
        'description',
        'candidate_id',
        'expected_impact'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
