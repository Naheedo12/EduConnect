<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Créer un nouveau cours
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $course = Course::create($validated);
        return response()->json($course, 201);
    }
}
