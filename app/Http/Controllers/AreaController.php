<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AreaController extends Controller
{
    public function getDistricts()
    {
        $districts = DB::table('areas')
                       ->select('District', 'DistrictName')
                       ->distinct()
                       ->get();
        
        return response()->json($districts);
    }

    public function getDistrictsdata()
    {
        $districts = DB::table('areas')
                       ->select('District', 'DistrictName')
                       ->distinct()
                       ->get();
        
        return $districts;
    }
    public function getTehsils($districtId)
    {
        $tehsils = DB::table('areas')
                     ->select('Tehsil', 'TehsilName')
                     ->where('District', $districtId)
                     ->distinct()
                     ->get();

        return response()->json($tehsils);
    }

    // to display the districts in view
    public function showDropdowns()
        {
            $districts = DB::table('areas')
                        ->select('District', 'DistrictName')
                        ->distinct()
                        ->get();

            return view('home.register', compact('districts'));
        }
}