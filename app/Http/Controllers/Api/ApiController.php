<?php

namespace App\Http\Controllers\Api;

use App\Models\Grad;
use App\Models\Student;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    // students progress by grades
    public function studentProgress($grade)
    {
        $students = Student::where('grade', $grade)->get();
        return response($students, 200);
    }

    public function getGradesFromLc($centerId)
    {
        $grades = $grades = Grad::whereIn('id', function ($query) use ($centerId) {
            $query->select('graid')->from('leaningcenter')->where('cid', $centerId);
        })->get();

        return response($grades, 200);
    }
}
