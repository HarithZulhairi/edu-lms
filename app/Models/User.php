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
     * @var list<string>
     */
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Relationship: An Educator HAS MANY Courses.
     */
    public function courses()
    {
        // Syntax: hasMany(RelatedModel, 'foreign_key', 'local_key')
        return $this->hasMany(Course::class, 'user_id', 'user_id');
    }

    /**
     * Relationship: A Learner BELONGS TO MANY Courses (via enrollments).
     */
    public function enrolledCourses()
    {
        // Syntax: belongsToMany(RelatedModel, 'pivot_table', 'this_model_fk', 'other_model_fk')
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id')
                    ->withPivot('enrollment_id', 'enrolled_at') // Access these columns if needed
                    ->withTimestamps();
    }
}
