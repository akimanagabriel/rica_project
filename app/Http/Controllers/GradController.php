<?php

namespace App\Http\Controllers;

use App\Models\Grad;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradController extends Controller
{
    public function index()
    {
        $grad = Grad::orderBy('id', 'ASC')->get();

        return view('pace.index', compact('grad'));
    }
   
    public function viewpace($id)
    {
    $results = DB::table('pace')
    ->select('pace.id', 'pace.code', 'pace.term', 'pace.status','pace.course', 'pace.id', 'course.short', 'course.id as cid', 'pace.pacenumber', 'pace.qte', 'pace.lica', 'grad.grad')
    ->join('course', 'pace.course', '=', 'course.id')
    ->join('grad', 'pace.grad', '=', 'grad.id')
    ->where('pace.grad', decrypt($id))
    ->orderBy('grad.id', 'asc')
    ->orderBy('course.id', 'asc')
    ->orderBy('pace.pacenumber', 'asc')
    ->get();
    $grad=Grad::where('id',decrypt($id))->get();
    $subjects=Course::all();
  
        return view('pace.pacelist', compact('results','grad','subjects'));
    }

    public function update(Request $request, $id) {
        dd($request->all());
    }

}
