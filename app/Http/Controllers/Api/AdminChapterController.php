<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Exception;
use Illuminate\Http\Request;

class AdminChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ChapterResource::collection(Chapter::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $chapter = Chapter::create([
                'name' => $request->name,
                'description' => $request->description,
                'course_id'  => $request->course_id,
                'user_id' => $request->user()->id,
            ]);
            return new ChapterResource($chapter);
        } catch (Exception $error) {
            return response()->json(array('error' => $error->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        return new ChapterResource($chapter);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chapter $chapter)
    {
        try {
            $chapter->update([
                'name' => $request->name,
                'description' => $request->description,
                'course_id'  => $request->course_id,
                'user_id' => $request->user()->id,
            ]);
            return new ChapterResource($chapter);
        } catch (Exception $error) {
            return response()->json(array('error' => $error->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        return $chapter->deleteOrFail();
    }
}
