<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('user.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:4",
            "email" => "required|email|unique:users",
            "username" => "required|min:3",
            "phone" => "required",
            "roles" => "required"
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->level = $request->roles;
        $user->password = "0000000000";
        $user->regnumber = "000000000";
        try {
            $user->save();
            // update password and regnumber
            if ($request->roles == "Admin") {
                $regNumber = "LICA" . str_pad($user->id, 3, 0, STR_PAD_LEFT);
            } else {
                $regNumber = "LICASP" . str_pad($user->id, 3, 0, STR_PAD_LEFT);
            }
            $user->password = $regNumber;
            $user->regnumber = $regNumber;
            $user->save();

            return redirect()->back()->with('success', "User created successsfully");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|min:3|string",
            "email" => "required|email",
            "username" => "required|min:3",
            "phone" => "required",
            "level" => "required"
        ]);
        $user = User::find($id);
        // correct user regnumber
        if ($request->roles == "Admin") {
            $regNumber = "LICA" . str_pad($user->id, 3, 0, STR_PAD_LEFT);
        } else {
            $regNumber = "LICASP" . str_pad($user->id, 3, 0, STR_PAD_LEFT);
        }
        $user->regnumber = $regNumber;
        $user->level = $request->level;
        $user->update($request->toArray());
        return redirect()->back()->with('success', 'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function disableEnable(string $id)
    {
        $user = User::find(decrypt($id));
        $newStatus = !$user->status;
        $user->status = $newStatus;
        $user->save();
        $message = "Done successfully";
        return redirect()->back()->with('success', $message);
    }
    public function resetPassword(string $id)
    {
        $user = User::find(decrypt($id));
        $user->password = $user->regnumber;
        $user->save();
        $message = "Password is reset to user's regstration number";
        return redirect()->back()->with('success', $message);
    }

    public function accountSetting()
    {
        $user = Auth::user();
        return view('user.myAccount', compact('user'));
    }
}
