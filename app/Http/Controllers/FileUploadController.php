<?php

namespace App\Http\Controllers;

use App\Models\PromotionSet;
use App\Models\Student;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{

    private function re_render(Request $request, $student_id)
    {
        $student = Student::where('id', $student_id)->get()[0];
        // CONGRATULATION SLIP
        $slipData = PromotionSet::where("stid", $student_id)->get();

        return view('student.profile', compact('student', 'slipData'));
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            "profilePicture" => "image|mimes:png,jpg|required|max:2048"
        ]);



        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            if ($file->move('profiles', $fileName)) {
                Student::where("id", $request->studentId)->update([
                    "photo" => $fileName
                ]);

                $this->re_render($request, $request->studentId);
            }
        }
    }
}
