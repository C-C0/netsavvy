<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEngagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'module_id',
        'time_spent',
        'interaction_frequency',
        'completion_rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
