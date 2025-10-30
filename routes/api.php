<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
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


//Ajouter un user
Route::post('/users', [UserController::class, 'store']);

//Creer un cours
Route::post('/courses', [CourseController::class, 'store']);

//Inscrire etudiant -> un cours
Route::post('/enroll', [EnrollmentController::class, 'enroll']);

//Cours d’ enseignant
Route::get('/teachers/{id}/courses', [UserController::class, 'taughtCourses']);

//Cours d’ etudiant
Route::get('/students/{id}/courses', [UserController::class, 'enrolledCourses']);
