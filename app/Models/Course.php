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
        'teacher_id',
    ];

    // Enseignant qui a creer le cours
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Etudiants inscrits au cours
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
                    ->withTimestamps()
                    ->withPivot('enrolled_at');
    }
}
