<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaceRequestMarksController extends Controller
{
    public function index()
    {
        $centers = Center::select('id', "cname")->distinct()->get();
        return view('paceRequestMarks.index', compact('centers'));
    }

    // public function studentProgress(Request $request)
    // {
    //     $centers = Center::select('id', "cname")->distinct()->get();
    //     $studentsResults = Student::where('grade', $request->gradeId)->orderBy('name')->get();
    //     return view('paceRequestMarks.index', compact(
    //         "centers",
    //         "studentsResults"
    //     ));
    // }
}
