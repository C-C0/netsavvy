<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStrengthsWeaknesses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'strengths',
        'weaknesses',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
