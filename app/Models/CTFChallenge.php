<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTFChallenge extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'difficulty_level',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
