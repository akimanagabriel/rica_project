<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaceRequestMarksController extends Controller
{
    public function index (){
        return view('paceRequestMarks.index');
    }
}
