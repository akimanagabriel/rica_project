<?php

namespace App\Http\Controllers;

use App\Models\Grad;
use App\Models\Location;
use App\Models\Academic;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Location::select('province')->groupBy('province')->get();
        $grades = Grad::orderBy('id', 'asc')->get();
        $academics = Academic::orderBy('year', 'asc')->get();
        $students = Student::where('status', '1')->latest()->get();
        return view('student.index', compact('students', 'provinces', 'academics', 'grades'));
    }

    /**
     * alumini.
     */
    public function alumini()
    {
        $provinces = Location::select('province')->groupBy('province')->get();
        $grades = Grad::orderBy('id', 'asc')->get();
        $academics = Academic::orderBy('year', 'asc')->get();
        $students = Student::where('status', '0')->orderBy('grade', 'asc')->orderBy('name', 'asc')->get();

        return view('student.alumini', compact('students', 'provinces', 'academics', 'grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Location::select('province')->groupBy('province')->get();
        $grades = Grad::orderBy('id', 'asc')->get();
        $academics = Academic::orderBy('year', 'asc')->get();

        return view('student.create', [
            'provinces' => $provinces,
            'academics' => $academics,
            'grades' => $grades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // validate
        $request->validate([
            'name' => 'required',
            'province' => 'required',
            'fphone' => 'required',
            'dob' => 'required',
            'district' => 'required',
            'ophone' => '',
            'fname' => '',
            'sector' => 'required',
            'mname' => '',
            'cell' => 'required',
            'gender' => 'required',
            'village' => 'required',
            'grade' => 'required',
            'year' => 'required',
            'comment' => 'required',
            'status' => 'required',
            'address' => '',
        ]);

        // $this->validate($request, );
        $regNumber = str_pad(Student::latest()->first()->id + 1, 4, '0', STR_PAD_LEFT);
        $request->merge([
            'cdate' => date('Y-m-d'),
            'userid' => auth()->user()->id,
            'regnumber' => 'LICAST' . $regNumber,
        ]);
        Student::create($request->all());
        return redirect()->route('student.index')->with('success', 'Student Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Student::find(decrypt($id))->update($request->all());
        return redirect()->back()->with('success', 'Student Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Student::find($id)->delete();
        return redirect()->back()->with('success', 'student removed successfully');
    }
}
