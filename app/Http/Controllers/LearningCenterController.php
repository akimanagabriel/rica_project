<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Grad;
use App\Models\LearningCenter;
use Illuminate\Http\Request;

class LearningCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::orderBy('id', 'ASC')->get();
        $grades = Grad::where('lcstatus', '0')->orderBy('id', 'ASC')->get();
        return view('learningCenter.learningCenters', compact('centers', 'grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * disable a spacefic center
     */
    public function disable($id)
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
    public function show(LearningCenter $learningCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearningCenter $learningCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LearningCenter $learningCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningCenter $learningCenter)
    {
        //
    }
}
