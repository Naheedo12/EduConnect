<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'in:admin,teacher,student',
        ]);

        // Crypter passwrd avant sauvegarde
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        return response()->json($user, 201);
    }

    // Cours learned par teacher
    public function taughtCourses($id)
    {
        $user = User::findOrFail($id);
        return $user->taughtCourses;
    }

    // Cours -> étudiant est inscrit
    public function enrolledCourses($id)
    {
        $user = User::findOrFail($id);
        return $user->enrolledCourses;
    }
}
