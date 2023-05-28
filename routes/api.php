<?php

use App\Http\Controllers\SocialiteController;
use App\Http\Resources\CourseResource;
use App\Http\Resources\PublicCourseResource;
use App\Http\Resources\UserResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/course', function () {
    return PublicCourseResource::collection(Course::all());
});

// Socialite Login routes
Route::get('/login/{provider}', [SocialiteController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteController::class,'handleProviderCallback']);

Route::middleware(['auth:sanctum'])->prefix('portal')->group(function () {
    // Users
    Route::get('/users', function () {
        return UserResource::collection(User::all());
    });
    Route::get('/user/{id}', function (string $id) {
        return new UserResource(User::findOrFail($id));
    });
    // Courses
    Route::get('/courses', function () {
        return CourseResource::collection(Course::all());
    });
});
