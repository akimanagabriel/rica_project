<?php

namespace App\Http\Controllers;

use App\Models\AssignGradeTeacher;
use Illuminate\Http\Request;

class AssignGradeTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = AssignGradeTeacher::select(
            'users.id as empid',
            'assign_grade_teachers.centerId',
            'assign_grade_teachers.id',
            'assign_grade_teachers.sdnumber',
            'users.name',
            'center.cname',
            'assign_grade_teachers.created_at',
            'assign_grade_teachers.status'
        )
            ->join('center', 'assign_grade_teachers.centerId', '=', 'center.id')
            ->join('users', 'assign_grade_teachers.teacherid', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->get();

            dd($assignments);

        return view('assign.assignTeacher');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignGradeTeacher $assignGradeTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignGradeTeacher $assignGradeTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignGradeTeacher $assignGradeTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignGradeTeacher $assignGradeTeacher)
    {
        //
    }
}
