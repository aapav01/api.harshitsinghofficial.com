<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('photos', 'public');
        }
        try {
            $course = Course::create([
                'name' => $request->name,
                'short' => $request->short,
                'description' => $request->description,
                'slug' => Str::slug($request->slug),
                'image' => $image,
                'latest_price' => $request->latest_price,
                'before_price' => $request->before_price,
                'public' => $request->public,
                'publish_at' => $request->publish_at,
                'user_id' => $request->user()->id,
            ]);
            return new CourseResource($course);
        } catch (Exception $error) {
            return response()->json(array('error' => $error->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('photos', 'public');
        }
        try {
            $course->update([
                'name' => $request->name,
                'short' => $request->short,
                'description' => $request->description,
                'slug' => Str::slug($request->slug),
                'image' => $image,
                'latest_price' => $request->latest_price,
                'before_price' => $request->before_price,
                'public' => $request->public,
                'publish_at' => $request->publish_at,
                'user_id' => $request->user()->id,
            ]);
            return new CourseResource($course);
        } catch (Exception $error) {
            return response()->json($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        return $course->deleteOrFail();
    }
}
