<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One-to-Many : Enseignant -> Courses
    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // Many-to-Many : Étudiant -> Courses
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }
}
