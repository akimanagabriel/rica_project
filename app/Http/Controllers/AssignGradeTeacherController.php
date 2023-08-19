<?php

namespace App\Http\Controllers;

use App\Models\AssignGradeTeacher;
use App\Models\Center;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignGradeTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = AssignGradeTeacher::select(
            'users.id as userId',
            'assign_grade_teachers.centerId',
            'assign_grade_teachers.id',
            'assign_grade_teachers.sdnumber',
            'users.name as supervisor',
            'center.cname',
            'assign_grade_teachers.created_at',
            'assign_grade_teachers.status',
        )
            ->join('center', 'assign_grade_teachers.centerId', '=', 'center.id')
            ->join('users', 'assign_grade_teachers.teacherid', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->get();

        $remainingCenters = Center::select('cname', 'id')->whereNotIn('id', function ($query) {
            $query->select('centerId')->from('assign_grade_teachers');
        })->get();


        $supervisors = User::where('level', 'Supervisor')
            ->distinct()
            ->orderBy('name')
            ->get();

        return view('assign.assignTeacher', compact(
            'assignments',
            'remainingCenters',
            'supervisors'
        ));
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
            "centerId" => "required|numeric",
            "teacherId" => "required|numeric",
            "status" => "required|numeric|between:0,1"
        ]);
        $request->merge([
            "userId" => Auth::user()->id
        ]);
        AssignGradeTeacher::create($request->toArray());
        return redirect()->back()->with("success", "Assigned successfully!");
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
    public function destroy(string $assignGradeTeacher)
    {
        try {
            AssignGradeTeacher::find(decrypt($assignGradeTeacher))->delete();
            $message = "Deleted successfully";
            $type = "success";
        } catch (Exception $e) {
            $message = $e->getMessage();
            $type = "error";
        }
        return redirect()->back()->with($type, $message);
    }
}
