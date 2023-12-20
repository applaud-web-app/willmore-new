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
                    <img src="{{ url('public/admin/images/logo.png') }}" alt="logo">
                </div>
            </div>
            <div class="main_body">
                <h1>Dear Admin,</h1>
                <div class="btnlbldiv">
                    <p>You can see the subscriber details bellow :</p>
                </div>           
                <div class="btnlbldiv">
                    <p><strong>Name: </strong> {{ $data->name }}</p>
                    @if($data->user_type=="P")
                        <p><strong>Subscriber Type: </strong> Professional</p>
                        <p><strong>Email: </strong> {{ $data->email }}</p>
                        <p><strong>Primary Skills: </strong> {{ $data->p_skill }}</p>
                        <p><strong>Secondary Skills: </strong> {{ $data->s_skill }}</p>
                        <p><strong>Industry Experience: </strong> {{ $data->ind_exp }}</p>
                    @else
                        <p><strong>Subscriber Type: </strong> Employer</p>
                        <p><strong>Company Name: </strong> {{ $data->company_name }}</p>
                        <p><strong>Designation: </strong> {{ $data->designation }}</p>
                        <p><strong>Company Email Address: </strong> {{ $data->company_email }}</p>
                    @endif
                    <p><strong>City: </strong> {{ $data->city }}</p>
                    <p><strong>Country: </strong> {{ $data->country }}</p>

                    @if($data->user_type=="P")
                        <p><strong>Lost Job Due To Covid-19 Pandemic: </strong> {{ @$data->lost_job }}</p>
                    @else
                        <p><strong>Startup: </strong> {{ $data->startup }}</p> 
                        <p><strong>Normally Hire Remote Talent On Project Basis: </strong> {{ $data->normally_hire }}</p> 
                        <p><strong>Want To Try Hiring Remote Talent On Project Basis: </strong> {{ $data->want_hiring }}</p>
                    @endif
                </div> 
                <hr>
                <p class="footertxt">Copyright © {{date('Y')}} WillAndMore Technologies Pvt.Ltd. | All Rights Reserved.</p>
                
            </div>
        </div>
    </body>
</html>