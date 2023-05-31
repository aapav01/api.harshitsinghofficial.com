<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $course = Course::where('slug', $input['course_slug'])->first();
        $enrollment = Enrollment::create([
            'bought_price' => $course->latest_price,
            'description' => 'Enrollment Request Created',
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['enrollment_id' => $enrollment->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }
}
