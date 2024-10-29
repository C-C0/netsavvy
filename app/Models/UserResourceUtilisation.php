<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResourceUtilisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resource_type',
        'resource_id',
        'accessed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
