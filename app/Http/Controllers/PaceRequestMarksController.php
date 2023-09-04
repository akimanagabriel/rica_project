<?php

namespace App\Http\Controllers;

use App\Models\Grad;
use App\Models\Center;
use App\Models\Student;
use App\Models\PaceRequest;
use App\Models\PromotionSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaceRequestMarksController extends Controller
{
    public function index(Request $request){
        $centers = Center::select('id', "cname")->distinct()->get();
        $grade = Grad::find($request->gradeId);
        if (!$grade) {
            return  view('paceRequestMarks.index', compact("centers"));
        }

        $students = Student::where('grade', $grade->id)->get();
        return view('paceRequestMarks.index', compact("centers", "students", "grade"));
    }

    public function paceRequestByStudent($id,$grade,$year){
        $results = DB::table('pecerequest')
            ->where('stid', decrypt($id))
            ->where('gradeid', decrypt($grade))
            ->where('year', decrypt($year))
            ->orderBy('setnumber', 'ASC')
            ->orderBy('paceid', 'ASC')
            ->get();

      $students = Student::where('id', decrypt($id))->get();
      $grade=decrypt($grade);
      $id=decrypt($id);
        return view('paceRequestMarks.studentpacerequest', compact("results","students","year","grade","id"));
    }


    public function pacereport(Request $request)
    {
        // Fetch set information
        $setInfo = PaceRequest::select('setnumber', 'setstatus', 'year', 'stid', "gradeid")
            ->where('stid', decrypt($request->student))
            ->where('year', $request->year)
            ->where('gradeid', $request->grade)
            ->groupBy('setnumber', 'setstatus', 'year', 'stid', "gradeid")
            ->orderBy('setnumber', 'asc')
            ->get();

        $current = $request->current;

        // Return the view with necessary data
        return view('paceRequestMarks.paceReport', compact("setInfo", "current"));
    }

    public function sendReport(Request $requestData)
    {
        $existingSet = PromotionSet::where('stid', $requestData->stid)
            ->where('setnumber', $requestData->setnumber)
            ->where('year', $requestData->year)
            ->where('grade', $requestData->grade)
            ->count();

        if ($existingSet > 0) {
            return redirect()->back()->with('error', 'You have already sent your report');
        } else {
            $promotionSet = new PromotionSet();
            $promotionSet->stid = $requestData->stid;
            $promotionSet->setnumber = $requestData->setnumber;
            $promotionSet->year = $requestData->year;
            $promotionSet->grade = $requestData->grade;
            $promotionSet->cdate = date("Y-m-d");
            $promotionSet->ctime = date("H:i:s");
            $promotionSet->status = 0;
            $promotionSet->tid = $requestData->user()->id;

            if ($promotionSet->save()) {
                PaceRequest::where('setnumber', $requestData->setnumber)
                    ->where('stid', $requestData->stid)
                    ->where('gradeid', $requestData->grade)
                    ->where('year', $requestData->year)
                    ->update(['setstatus' => 1]);

                return redirect()->back()->with('success', 'Thank you for sending the Pace Set Report');
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again or contact admin');
            }
        }
    }
}
