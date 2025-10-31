<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($id);
        $user = User::findOrFail($validated['user_id']);

        // student deja inscrit ??
        if ($user->enrolledCourses()->where('course_id', $id)->exists()) {
            return response()->json(['message' => 'Étudiant déjà inscrit à ce cours'], 400);
        }

        // Inscrire student
        $user->enrolledCourses()->attach($course->id);

        return response()->json(['message' => 'Inscription réussie !'], 201);
    }
}
