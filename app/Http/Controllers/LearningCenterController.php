<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Grad;
use App\Models\LearningCenter;
use Exception;
use Illuminate\Http\Request;

class LearningCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::latest()->get();
        $grades = Grad::where('lcstatus', '1')->orderBy('id', 'ASC')->get();
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
        $center = Center::find(decrypt($id));

        if ($center) {
            $newStatus = !$center->status; // Toggle the status
            $center->update([
                'status' => $newStatus
            ]);

            $message = "Learning center is " . ($newStatus ? "activated" : "deactivated");
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', "Learning center not found.");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "cname" => "required",
            "status" => "required"
        ]);
        $request->merge(['cdate' => date('Y-m-d')]);
        Center::create($request->toArray());
        return redirect()->back()->with('success', "Learning center created!");
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
    public function update(Request $request, string $lcId)
    {
        $request->validate([
            'cname' => 'required|min:2'
        ]);
        Center::find($lcId)->update($request->toArray());
        return redirect()->back()->with('success', "Learning center is updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $learningCenterId)
    {
        LearningCenter::where('graid', decrypt($learningCenterId))->delete();
        return redirect()->back()->with('success', "Grade removed");
    }

    public function assignGrade(Request $request)
    {
        $request->validate([
            "cid" => "required",
            "graid" => "required|unique:leaningcenter"
        ]);
        $request->merge([
            'cdate' => date('Y-m-d')
        ]);
        LearningCenter::create($request->toArray());
        return redirect()->back()->with('success', 'Grade assigned successfully');
    }
}
