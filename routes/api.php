<?php

use App\Http\Controllers\Api\AdminChapterController;
use App\Http\Controllers\Api\AdminCourseController;
use App\Http\Controllers\Api\AdminEnrollmentController;
use App\Http\Controllers\Api\AdminLessonController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\RazorpayController;
use App\Http\Controllers\SocialiteController;
use App\Http\Resources\EnrollmentResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\PublicChapterResource;
use App\Http\Resources\PublicCourseResource;
use App\Http\Resources\UserResource;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Enrollment;
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

Route::get('/course', function () {
    return PublicCourseResource::collection(Course::where([
        ['public', true],
        ['publish_at', '<=', now()]
    ])->get());
});

Route::get('/course/{slug}', function (string $slug) {
    return new PublicCourseResource(Course::where([
        ['slug', $slug],
        ['public', true],
        ['publish_at', '<=', now()]
    ])->first());
});

Route::get('/chapter/{id}', function (string $id) {
    return new PublicChapterResource(Chapter::findOrFail($id));
});

// Socialite Login routes
Route::get('/login/{provider}', [SocialiteController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteController::class,'handleProviderCallback']);

// Auth User
Route::middleware(['auth:sanctum'])->group(function () {
    // Me
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
    // Lesson
    Route::get('/lesson/{id}', function(string $id) {
        return new LessonResource(Lesson::findOrFail($id));
    });
    // Payment
    Route::post('/payment', [RazorpayController::class, 'store'])->name('api.payment');
    Route::post('/enroll-order', [EnrollmentController::class, 'store'])->name('api.order');
});

Route::middleware(['auth:sanctum'])->prefix('portal')->group(function () {
    Route::get('/funfacts', function (Request $request) {
        $enrollments = EnrollmentResource::collection(Enrollment::where('status', 'paid')->get());
        return response()->json([
            'students' =>  User::has('roles','<=', 0)->count(),
            'courses' => Course::where('public', true)->count(),
            'enrollments' => $enrollments->count(),
            'earningsTotal' => $enrollments->sum('bought_price'),
            'videos' => Lesson::where('type', 'video')->count(),
        ]);
    });
    // Users
    Route::apiResource('users', AdminUserController::class);
    // Courses
    Route::apiResource('course', AdminCourseController::class);
    // Chapter
    Route::apiResource('chapter', AdminChapterController::class);
    // Lesson
    Route::apiResource('lesson', AdminLessonController::class);
    // Enrollments
    Route::apiResource('enrollment', AdminEnrollmentController::class);
});
