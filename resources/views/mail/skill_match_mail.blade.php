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
                <div class="container_logo_div_inner">
                    <img src="{{ url('public/admin/images/logo.png') }}" alt="">
                </div>
            </div>
            <div class="main_body">
                <h1>Dear {{ @$data['name'] }},</h1>
                <div class="btnlbldiv">
                    @foreach(@$data['projects'] as $val)
                        <p><a target="_blank" href="{{@$val['project_link']}}">{{@$val['employer']}}</a> has add new project <a target="_blank" href="{{@$val['profile_link']}}">{{@$val['projecttitle']}}</a></p>
                    @endforeach
                </div>
            </div>
                <p class="footertxt">Copyright © {{date('Y')}} Dignifiedme Technologies Pvt.Ltd. | All Rights Reserved.</p>
                <p class="footertxt">
                    <a href="{{route('privacy_policy')}}" target="_blank">Privacy Policy</a>   |   
                    <a href="{{route('terms_and_conditions')}}" target="_blank">Terms and Conditions</a>   |   
                    <a href="{{route('notification.setting')}}" target="_blank">Unsubscribe</a>   |   
                    <a href="{{route('contact_us')}}" target="_blank">Get Support</a>
                </p>
                <p class="footericon">
                    <a target="_blank" href="https://www.linkedin.com/company/dignifiedme"><img src="{{asset('public/images/so1.png')}}"></a>
                    <a target="_blank" href="https://www.facebook.com/dignifiedmetech"><img src="{{asset('public/images/so3.png')}}"></a>
                    <a target="_blank" href="https://twitter.com/dignifiedmetech"><img src="{{asset('public/images/so2.png')}}"></a>
                    <a target="_blank" href="https://www.instagram.com/dignifiedmetech"><img src="{{asset('public/images/so4.png')}}"></a>
                </p>
        </div>
    </body>
</html>