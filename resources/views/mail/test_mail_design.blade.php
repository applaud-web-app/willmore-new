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
				<h1>Dear Test,</h1>
				<div class="body_text_div">
					<p class="ptitle">Username :</p>
					<p class="pdetails">Username name here Se Will</p>
				</div>
				<div class="body_text_div">
					<p class="ptitle">Password :</p>
					<p class="pdetails">abcd145235</p>
				</div>			
				<div class="btnlbldiv">
					<p>please click the link below :</p>
				</div>
				<div class="btndiv">
					<a href="#">Click Here</a>
				</div>
			</div>
				<p class="footertxt">Copyright © {{date('Y')}} Dignifiedme Technologies Pvt.Ltd. | All Rights Reserved.</p>
				<p class="footertxt">
					<a href="javascript:;">Privacy Policy</a>   |   
					<a href="javascript:;">Terms and Conditions</a>   |   
					<a href="javascript:;">Unsubscribe</a>   |   
					<a href="javascript:;">Get Support</a>
				</p>
				<p class="footericon" >
					{{-- <div style="text-align: center;" data-url="{{route('home')}}" class="addthis_inline_share_toolbox_2aqf float-right"></div> --}}
                    <a class="linkdin-icon" href="javascript:;"><img src="{{asset('public/images/so1.png')}}"></a>
                    <a class="twitter-icon" href="javascript:;"><img src="{{asset('public/images/so2.png')}}"></a>
                    <a class="facebook-icon" href="javascript:;"><img src="{{asset('public/images/so3.png')}}"></a>
                    <a class="instra-icon" href="javascript:;"><img src="{{asset('public/images/so4.png')}}"></a>
				</p>
		</div>
		{{-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d68cde4fb5ca0be"></script> --}}
	</body>
</html>