<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'DESC')->get();
        return view('course.subjects', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "cousename" => "required",
            "shortname" => "required"
        ]);
        Course::create($request->toArray());
        return redirect()->back()->with('success', "Course created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $courseId)
    {
        // dd($request->toArray());
        $request->validate([
            "cousename" => "required|min:2",
            "shortname" => "required|min:2"
        ]);
        Course::find(decrypt($courseId))->update($request->toArray());
        return redirect()->back()->with('success', "Subject updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
