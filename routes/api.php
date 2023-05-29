<?php

use App\Http\Controllers\SocialiteController;
use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\PublicChapterResource;
use App\Http\Resources\PublicCourseResource;
use App\Http\Resources\UserResource;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
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

Route::get('/course/{slug}', function (string $slug) {
    return new PublicCourseResource(Course::where('slug', $slug)->first());
});

Route::get('/chapter/{id}', function (string $id) {
    return new PublicChapterResource(Chapter::findOrFail($id));
});

// Socialite Login routes
Route::get('/login/{provider}', [SocialiteController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteController::class,'handleProviderCallback']);

// User
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/lesson/{id}', function(string $id) {
        return new LessonResource(Lesson::findOrFail($id));
    });
});

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
