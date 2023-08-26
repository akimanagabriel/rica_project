<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grad;
use App\Models\PromotionSet;
use App\Models\Student;
use Exception;

class StudentResultController extends Controller
{
    public function results()
    {
        $centers = Center::select('id', "cname")->distinct()->get();
        return view('student.results', compact('centers'));
    }

    public function profile(Request $request)
    {

        $student = Student::where('id', $request->studentId)->get()[0];
        // CONGRATULATION SLIP
        $slipData = PromotionSet::where("stid",$request->studentId)->get();
        
        return view('student.profile', compact('student', 'slipData'));
    }

    public function getStudents(Request $request)
    {
        try {

            $centers = Center::select('id', "cname")->distinct()->get();
            $grade = Grad::find($request->gradeId);
            $students = Student::where('grade', $grade->id)->get();
            return view('student.results', compact('students', 'centers'));
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }
}
