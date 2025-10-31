<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

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

    // Afficher tous les cours
    public function index()
    {
        $courses = Course::with('teacher')->get();

        return response()->json($courses, 200);
    }

    // Cours details
    public function show($id)
    {
        $course = Course::find($id);

        if (! $course) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }

        return response()->json($course, 200);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (! $course) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'teacher_id' => 'sometimes|required|exists:users,id',
        ]);

        $course->update($validated);

        return response()->json([
            'message' => 'Cours modifié avec succès',
            'course' => $course,
        ], 200);
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (! $course) {
            return response()->json(['message' => 'Cours non trouvé'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Cours supprimé avec succès'], 200);
    }

}
