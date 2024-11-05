<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function tutorials()
    {
        return $this->hasMany(Tutorial::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function ctfChallenges()
    {
        return $this->hasMany(CTFChallenge::class);
    }
}
