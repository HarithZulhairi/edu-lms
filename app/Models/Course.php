<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'course_id';

    protected $fillable = [
        'title',
        'description',
        'thumbnail_url',
        'user_id', 
    ];

    /**
     * Relationship: A Course BELONGS TO an Educator (User).
     */
    public function educator()
    {
        // Syntax: belongsTo(RelatedModel, 'foreign_key', 'owner_key')
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Relationship: A Course HAS MANY Students (Users).
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')
                    ->withPivot('enrollment_id', 'enrolled_at')
                    ->withTimestamps();
    }
}