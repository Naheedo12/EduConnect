<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Course;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Ajouter un utilisateur (admin, teacher ou student)
Route::post('/users', function (Request $request) {
    return User::create($request->all());
});

// Créer un cours (nécessite un teacher_id)
Route::post('/courses', function (Request $request) {
    return Course::create($request->all());
});

// Inscrire un étudiant à un cours (table pivot course_user)
Route::post('/enroll', function (Request $request) {
    $user = User::find($request->user_id);      // Trouver l'utilisateur
    $course = Course::find($request->course_id); // Trouver le cours
    $user->enrolledCourses()->attach($course->id); // Ajouter dans la table pivot
    return response()->json(['message' => 'Inscription réussie !']);
});

// les cours créés par un enseignant
Route::get('/teachers/{id}/courses', function ($id) {
    return User::find($id)->taughtCourses;
});

// les cours auxquels un étudiant est inscrit
Route::get('/students/{id}/courses', function ($id) {
    return User::find($id)->enrolledCourses;
});
