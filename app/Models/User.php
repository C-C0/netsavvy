<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'skill_level',
        'preferred_learning_style',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Relationships
    public function skillLevelAssessments()
    {
        return $this->hasMany(SkillLevelAssessment::class);
    }

    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class);
    }

    public function ctfs()
    {
        return $this->belongsToMany(CTFChallenge::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function badges()
    {
        return $this->hasMany(UserBadge::class);
    }

    public function strengthsWeaknesses()
    {
        return $this->hasOne(UserStrengthsWeaknesses::class);
    }

    public function feedback()
    {
        return $this->hasMany(UserFeedback::class);
    }

    public function resourceUtilizations()
    {
        return $this->hasMany(UserResourceUtilization::class);
    }

    public function engagements()
    {
        return $this->hasMany(UserEngagement::class);
    }
}
