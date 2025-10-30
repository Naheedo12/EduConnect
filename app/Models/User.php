<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    public function taughtCourses() {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function enrolledCourses() {
        return $this->belongsToMany(Course::class, 'course_user')->withTimestamps();
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isTeacher() {
        return $this->role === 'teacher';
    }

    public function isStudent() {
        return $this->role === 'student';
    }
}

