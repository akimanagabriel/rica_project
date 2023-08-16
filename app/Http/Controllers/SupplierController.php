<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('supplier.suppliers', compact('suppliers'));
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
            "sname" => "required",
            "phone" => "required",
            "address" => "required",
            "status" => "required",
        ]);
        $request->merge([
            'userid' => Auth::user()->id,
            'cdate' => date('Y-m-d')
        ]);
        // return dd($request->all());
        Supplier::create($request->toArray());
        return redirect()->back()->with('success', 'Pace supplier created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $supplierId)
    {
        $supplier = Supplier::find(decrypt($supplierId))->update($request->toArray());
        return redirect()->back()->with('success', 'Supplier changed successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $supplierId)
    {
        Supplier::find(decrypt($supplierId))->delete();
        return redirect()->back()->with('success', 'Supplier removed successfully');
    }
}
