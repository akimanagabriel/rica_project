<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Grad;
use App\Models\GradeCourse;
use Illuminate\Http\Request;

class GradeCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gradescourses = Grad::orderBy('id', 'ASC')->get();
        $subjects = Course::orderBy('id', 'ASC')->get();
        return view('grade.grades', compact('gradescourses', 'subjects'));
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
        if (GradeCourse::find($request->cid)) {
            return redirect()->back()->with('error', "course already exist");
        }
        GradeCourse::create($request->toArray());
        return redirect()->back()->with('success', "Course added");
    }

    /**
     * Display the specified resource.
     */
    public function show(GradeCourse $gradeCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GradeCourse $gradeCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GradeCourse $gradeCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $gradeCourseId)
    {
        $gradeCourse = GradeCourse::find(decrypt($gradeCourseId));
        $gradeCourse->delete();
        return redirect()->back()->with('success', "course removed to Grade");
    }
}
