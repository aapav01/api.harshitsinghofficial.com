<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AdminLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LessonResource::collection(Lesson::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $lesson = Lesson::create([
                'title' => $request->title,
                'description' => $request->description,
                // 'thumb_url' => $request->thumb_url,
                // 'length' => $request->length,
                'url' => $request->url,
                'position' => $request->position,
                'type' => $request->type,
                'status' => $request->status,
                'platform' => $request->platform,
                'public' => $request->public,
                'user_id' => $request->user()->id,
                'chapter_id' => $request->chapter_id,
            ]);
            return new LessonResource($lesson);
        } catch (\Exception $e) {
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return new LessonResource($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        try {
            $lesson->update([
                'title' => $request->title,
                'description' => $request->description,
                // 'thumb_url' => $request->thumb_url,
                // 'length' => $request->length,
                'url' => $request->url,
                'position' => $request->position,
                'type' => $request->type,
                'status' => $request->status,
                'platform' => $request->platform,
                'public' => $request->public,
                'user_id' => $request->user()->id,
                'chapter_id' => $request->chapter_id,
            ]);
            return new LessonResource($lesson);
        } catch (\Exception $e) {
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        return $lesson->deleteOrFail();
    }
}
