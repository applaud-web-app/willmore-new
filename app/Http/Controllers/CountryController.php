<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    
    public function getCountryStateApi(Request $request){
        $country = $request->country;
        $statesData = getStateFromApi($country);
        return response()->json($statesData);
    }
}
