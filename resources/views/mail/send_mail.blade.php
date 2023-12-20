<!DOCTYPE html>
<html>
    <head>
        <title>Mail</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('mail.layouts.header')
    </head>
    <body>
        <div class="container">
           <div class="container_logo_div">
                <div class="container_logo_div_inner" @if(@$logo_center==1) style="text-align: center !important;" @endif>
                    <img src="{{ URL::to('public/images/logo.png') }}" alt="">
                </div>
            </div>
            <div class="main_body">
                {!!@$mailBody!!}
            </div>
                <p class="footertxt">Copyright © {{date('Y')}} WillAndMore | All Rights Reserved.</p>
                
        </div>
    </body>
</html>