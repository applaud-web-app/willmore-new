<!DOCTYPE html>
<html>

<head>
    <title>Verification Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <style type="text/css">
        .linkk:hover {
            background: #01b02e !important;
        }
        .btn{
            background:#05a85c;
            font-family: 'Source Sans Pro', sans-serif;
            color: white;
            font-size: 17px;
            padding: 10px 10px;
            margin-top: 4px;
            margin-left: 30%;
            display: block;
            border-radius: 5px;
            margin-top:20px;
            margin-bottom:20px;
            text-align: center;
            width: 180px;
        }
    </style>
    
    <div style="max-width:640px; margin:0 auto;">
        <div
            style="/*width:620px;*/background:#F9F9F9; /*padding: 0px 10px;*/ border:1px solid transparent; border-bottom: none;height: 100px; margin: -9px 0px -13px 0px;">
            <div
                style="float: none; text-align: center; margin-top: 20px; background:url('{{ URL::to('#') }}') repeat center center">
                <img src="{{URL::to(env('AWS_BUCKET_URL').'public/frontend/images/logo.png')}}" width="135" alt="">
            </div>
        </div>
        <div style="max-width:620px; border:1px solid transparent; margin:0 0; padding:15px; ">

            <div style="display:block; overflow:hidden; width:100%;">

                Hello {{@$data['name']}},
                

            <p style="font-family:Arial; font-size:14px; font-weight:500; color:#f43930;margin: 0px 0px 10px 0px;">
                Your OTP to continue login as Nominee/Executor is - {{@$data['otp']}}<strong> </strong>
            </p>
            <p class="footertxt">Copyright © {{date('Y')}} WillAndMore | All Rights Reserved.</p>

        </div>
    </div>
</body>

</html>
