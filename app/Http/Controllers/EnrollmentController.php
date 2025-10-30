<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class EnrollmentController extends Controller
{
    // Inscrire etudiant to un cours
    public function enroll(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $course = Course::findOrFail($validated['course_id']);

        // Ajouter l'inscription
        $user->enrolledCourses()->attach($course->id);

        return response()->json(['message' => 'Inscription réussie !']);
    }
}
