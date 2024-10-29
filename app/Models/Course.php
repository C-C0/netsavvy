<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'module_id',
        'tutorial_id',
        'quiz_id',
        'challenge_id',
        'required_skill_level',
        'preferred_learning_style',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function challenge()
    {
        return $this->belongsTo(CTFChallenge::class);
    }
}
