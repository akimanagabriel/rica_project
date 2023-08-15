<?php

namespace App\Http\Controllers;

use App\Models\Location;

class LocationController extends Controller
{
    //province
    public function getProvinces()
    {
        $provinces = Location::select('province')->groupBy('province')->get();
        return response()->json($provinces);
    }
    // get districts
    public function getDistricts($province)
    {
        $districts = Location::select('district')->where('province', $province)->groupBy('district')->get();
        return response()->json($districts);
    }
    // get sectors
    public function getSectors($district)
    {
        $sectors = Location::select('sector')->where('district', $district)->groupBy('sector')->get();
        return response()->json($sectors);
    }
    // get cells
    public function getCells($sector)
    {
        $cells = Location::select('cell')->where('sector', $sector)->groupBy('cell')->get();
        return response()->json($cells);
    }
    // get villages
    public function getVillages($cell)
    {
        $villages = Location::select('village')->where('cell', $cell)->groupBy('village')->get();
        return response()->json($villages);
    }
}
