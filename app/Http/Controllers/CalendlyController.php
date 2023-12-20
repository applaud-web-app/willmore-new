<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendlyController extends Controller
{
    
    public function calendlyTest(){
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://auth.calendly.com/oauth/authorize?client_id=xxYJJbaQwnUBrRU8PqTQWuQkI21dZQJZEekN7OsMKIA&response_type=code&redirect_uri=http://localhost/willandmore-v2/calendly-authorize",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function calendlyAuthorize(){
        return view('welcome');
    }
}
