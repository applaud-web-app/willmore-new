<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '87464212873-hhq6i0nghbebsh9lebodfddirrh90die.apps.googleusercontent.com',
        'client_secret' => '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', 
        //'redirect' => 'https://digiaccess24.com/digilancers/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '342980568042996',
        'client_secret' => 'd37acf8c8b3c6f031dd4f4b1764cf00a',
        //'redirect' => 'https://digiaccess24.com/digilancers/auth/facebook/callback',
      ], 

    'pusher' => [
        'pusher_app_id' => '1466958', 
        'pusher_app_key' => '8d6c6fbc431c83be86b4',         
        'pusher_app_secret' => 'f270bb4bf7c46c8719c0', 
        'pusher_app_cluster' => 'ap2', 
    ],
    'firebase_otp'=>[
        "apiKey"=> "AIzaSyA5kretb-RqvqAYhKjxlpcdeHcFrYbclig",
        "authDomain"=> "aplu-1596609459095.firebaseapp.com",
        "databaseURL"=> "https://aplu-1596609459095.firebaseio.com",
        "projectId"=> "aplu-1596609459095",
        "storageBucket"=> "aplu-1596609459095.appspot.com",
        "messagingSenderId"=> "1061062480969",
        "appId"=> "1:1061062480969:web:9f9f368136e699ae6a9b98"
    ],
    'calendly_api'=>[
        'access_token'=>'eyJraWQiOiIxY2UxZTEzNjE3ZGNmNzY2YjNjZWJjY2Y4ZGM1YmFmYThhNjVlNjg0MDIzZjdjMzJiZTgzNDliMjM4MDEzNWI0IiwidHlwIjoiUEFUIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiJodHRwczovL2F1dGguY2FsZW5kbHkuY29tIiwiaWF0IjoxNzAxMTUxOTA3LCJqdGkiOiJhMTc1OTgzMC03ZTAzLTQyY2MtYTQ0Yy0xMzQ0OWNmYjM5MjAiLCJ1c2VyX3V1aWQiOiIwNTM0NWIyNy1mMzc2LTQ1NzgtYTlmOS0zMDAzNzVmMmU1ZjAifQ.zPs88FcTJasFMgu3vn_pWgRtG5mYPANC1_WX9aa-rNr8LjDgoiI2-hSz6u0wB6LoCJNVdfh890SBeqs5-iKp5g',
        'calendly_url'=>'https://calendly.com/chitragupta147896325',
        'client_id'=>'qcjI-sZMg7xFfmVMSRrtHZ9QxCKFPtukGWYCmmW_SPo',
        'client_secret'=>'arEutdJQ7ie5FClw3vj5HYnzBerl7nBV0Zqiu-Kat5M',
        'webhook_sign_key'=>'enFSkl7yXdgwoVG0frehcXZ5V9hUX6CytpONfGaJgZg',
    ]

];
