<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grad;

class PaceRequestMarksController extends Controller
{
    public function index()
    {
        $centers = Center::select('id', "cname")->distinct()->get();
        return view('paceRequestMarks.index', compact('centers'));
    }

    public function studentProgress(Request $request)
    {
        $grade = Grad::find($request->gradeId);
        $students = Student::where('grade', $grade->id)->get();
        $centers = Center::select('id', "cname")->distinct()->get();
        return view('paceRequestMarks.index', compact("centers",""));
    }
}
