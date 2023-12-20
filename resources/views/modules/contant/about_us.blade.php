@extends('layouts.app')
@section('title','About Us')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<section class="pager-section banner_img ">
    <div class="container">
        <div class="main-banner-content p-relative">
            @include('includes.social_links')
            <!--social-links end-->
            <div class="pager-content">
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>About Us</span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">About Us</h2>
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->

<section class="block block_1_top">
    <div class="container">
        <div class="about-section">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="abt-img">
                        <img src="{{asset('public/images/video_thumb3.png')}}" alt="" class="w-100">
                        <a href="{{asset('public/willandmore_video.mp4')}}" title="" class="play-btn html5lightbox"><i
                                class="fa fa-play"></i></a>
                    </div>
                    <!--abt-img end-->
                </div>
                <div class="col-lg-6">
                    <div class="about-text style2">
                        <h2>About Us</h2>
                        <p>The goal of Will&More is to help secure your familes future by ensuring that you have a
                            Will in place that records your final wishes and enables your assests and properties to be distributed the way you like it.</p>

                        <p>When you write a Will, you’ll also want to be sure that after you pass away,
                            your family can find it easily and so ensure that your wishes are carried out rather than having
                            your assets and properties distributed purely as per the laws of succession.</p>

                        <p>It may also happen that you become disabled and incapacitated due to an accident or illness such as Alzheimer’s or
                            Parkinson’s. In such an unfortunate event, you may want to leave specific instructions to your loved ones about
                            valuable items, financial documents, insurance papers, pension papers, share certificates, mutual fund details,
                            digital assets and ways to access and use them or even certain specific relationship or religious ceremonies that
                            you may want.</p>

                    </div>
                    <!--about-text end-->
                </div>
            </div>
            <div class="row mt-80 align-items-center">
                <div class="col-lg-12">
                    <div class="about-text style2 pl-0 pr-60">

                        <p>You can record the details of this information in a Letter of Instructions and store it with us safely, securely and confidentially.
                            This will only be communicated to your nominees, after they provide us with a medical certificate.</p>

                        {{-- <p>Additionally, you may want to leave specific instructions to your loved ones about valuable items,
                            financial documents, insurance papers, pension papers, share certificates, mutual fund details, digital assets or even
                            certain specific relationship or religious ceremonies that you may want.</p>
                        <p>You can record the details of this information in a Letter of Instructions and store it with us safely, securely and confidentially.
                            This will only be communicated after your passing as per your prior instructions, or in exceptional circumstances such as debilitating
                            illness or disability, incapacitating you from acting in your own interest.</p>
                        <p>Your family and loved ones will then be spared the anguish and worry of not knowing the specific details of your assets.
                            It will be a smooth transition for them.</p> --}}
                    </div>
                    <!--about-text end-->
                </div>
                {{--<div class="col-lg-6">
                    <div class="abt-img overlay">
                        <img src="https://via.placeholder.com/620x413" alt="" class="w-100">
                    </div>
                    <!--abt-img end-->
                </div>--}}
            </div>
        </div>
        <!--about-section end-->
    </div>
</section>

<section class="block pt-5">
    <div class="container">
        <div class="about-section">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="abt-img">
                        <div class="abt-img overlay">
                            <img src="{{asset('public/images/company_history.png')}}" alt="" class="w-100">
                        </div>
                    </div>
                    <!--abt-img end-->
                </div>
                <div class="col-lg-6">
                    <div class="about-text style2">
                        <h2>The history of our company will surprise you</h2>
                        <p>In other countries around the world, such as the United Kingdom, USA, Australia and Singapore,
                            there is a culture of writing a Will to ensure that your assets and properties are left to your
                            family and loved ones and distributed in the manner you wish after you pass away.
                        </p>
                        <p>These countries also have a national Will Location Service, or Register, enabling any
                            Will to be found and retrieved after a person passes away.
                        </p>
                    </div>
                    <!--about-text end-->
                </div>
            </div>
            <div class="row mt-80 align-items-center">
                <div class="col-lg-12">
                    <div class="about-text style2 pl-0 pr-60">
                        <p>Will & More was created to bring these established worldwide best practices to India,
                            to promote a culture of Will writing and the practice of registering the location of your Will.
                        </p>
                        <p>Will & More is also passionate about creating a culture of leaving a Letter of Instructions for your loved ones if you become incapacitated;
                             this will help your loved ones to access useful and critical information they need in difficult times.
                        </p>
                        <p class="m-0">During the COVID pandemic we saw how family members did not have information regarding bank accounts of sole earning members or
                            know how to operate them even to meet urgent medical expenses.
                        </p>
                    </div>
                    <!--about-text end-->
                </div>
                {{--<div class="col-lg-6">
                    <div class="abt-img overlay">
                        <img src="https://via.placeholder.com/620x413" alt="" class="w-100">
                    </div>
                    <!--abt-img end-->
                </div>--}}
            </div>
        </div>
        <!--about-section end-->
    </div>
</section>

<section class="block">
    <div class="fixed-bg banner_img bg1"></div>
    <div class="container">
        <div class="section-title">
            <h2 class="h-title">We are the ones you need</h2>
        </div>
        <!--section-title end-->
        <div class="services">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0ms">
                        <h2>01<span>.</span></h2>
                        <h4>Convenience</h4>
                        <p>Create a Will online  from the comfort of your own home, at a time that is convenient for you.</p>
                    </div>
                    <!--service-col end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="200ms">
                        <h2>02<span>.</span></h2>
                        <h4>Cost</h4>
                        <p>Creating a Will online is cost-effective when you create one with willandmore.com</p>
                    </div>
                    <!--service-col end-->
                </div>
                <div class="col-lg-6">
                    <div class="smpl-txt">
                        <h4>Why are we different?</h4>
                        <p>Unlike other online Will creation services, we have the legal expertise to both create your
                            Will online and offline and also assist you register it with the required state-specific requirements.
                            This ensures that disputes and delays are minimised in executing your Will.</p>
                        <p>We are also committed to providing the best customer service possible, with a team of experienced legal
                            professionals available to answer your questions and address your concerns.</p>
                        <p>Thanks to our unique combination of legal services, adherence to stringent Will
                            privacy norms and customer care, you can rest assured that your Will is created with
                            the utmost attention to detail and accuracy. We have the expertise, experience, and
                            dedication to make sure that your final wishes are respected, and your assets and properties are
                            distributed as per your wishes.</p>
                    </div>
                    <!--smpl-txt end-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">
                        <h2>03<span>.</span></h2>
                        <h4>Accuracy</h4>
                        <p>Willandmore.com uses simple questionnaires and prompts to ensure that all necessary information is included in the document.</p>
                    </div>
                    <!--service-col end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <h2>04<span>.</span></h2>
                        <h4>Ease of updates</h4>
                        <p>If you need to make changes to your Will, it is easier done on willandmore.com.</p>
                    </div>
                    <!--service-col end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="800ms">
                        <h2>05<span>.</span></h2>
                        <h4>Privacy</h4>
                        <p>Your Will contains sensitive and personal financial information. Willandmore.com is absolutely secure and offers complete privacy.</p>
                    </div>
                    <!--service-col end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="1000ms">
                        <h2>06<span>.</span></h2>
                        <h4>Accessibility</h4>
                        <p>willandmore.com is accessible across all desktops and mobile devices.</p>
                    </div>
                    <!--service-col end-->
                </div>
            </div>
        </div>
        <!--services end-->
    </div>
</section>

<section class="block2">
    <div class="fixed-bg light-bg"></div>
    <div class="container">
        <div class="counter-section">
            <div class="row row_center">
                <div class="col-md-3 col-sm-4">
                    <div class="counter-col col-center">
                        <h2><span class="count">250</span></h2>
                        <span>Online Wills created</span>
                    </div>
                    <!--counter-col end-->
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="counter-col col-center">
                        <h2><span class="count">50</span></h2>
                        <span> Letter of Instructions</span>
                    </div>
                    <!--counter-col end-->
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="counter-col col-center">
                        <h2><span class="count">150</span></h2>
                        <span>Will Location Registry service availed</span>
                    </div>
                    <!--counter-col end-->
                </div>
                {{-- <div class="col-md-3 col-sm-4">
                    <div class="counter-col">
                        <h2><span class="count">77</span>%</h2>
                        <span>cases won</span>
                    </div>
                    <!--counter-col end-->
                </div> --}}
            </div>
        </div>
        <!--counter-section end-->
    </div>
</section>

<section class="block">
    <div class="fixed-bg banner_img bg2"></div>
    <div class="container">
        <div class="section-title">
            <h2 class="h-title mw-100">Receive consultation</h2>
            <span>Contact us today for a friendly, no-obligation chat to discuss your Will.</span>
            <span>Complete the form below, and we’ll call you back.</span>
        </div>

        <div id="msg" class="alert alert-success alert-dismissible" style="display: none;text-align: center;max-width: 930px;">
            <span>Consultation Request Send Successfully</span>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>

        <!--section-title end-->
        <div class="consulation-form">
            <form method="GET" name="contact_form" id="contact_form">
                @csrf
                <input type="hidden" name="form_type" id="form_type" value="C" class="form-control">

                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your name">
                        </div>
                        <!--form-group end-->
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*">
                        </div>
                        <!--form-group end-->
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <button type="submit" class="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
        <!--consulation-form end-->
    </div>
</section>
{{--
<section class="block2">
    <div class="fixed-bg light-bg"></div>
    <div class="container">
        <div class="pt-logos text-center">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">IDENTITY</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">MOUNTA</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">GLOBE</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">CIRCLE</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
            </div>
        </div>
        <!--pt-logos end-->
    </div>
</section>
--}}
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@include('includes.toaster')
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
<script>
    $(document).ready(function() {
        $.validator.addMethod("name_Regex", function(value, element) {
         return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
         }, "Name must contain only letters");

        $('#contact_form').validate({
            rules: {
                name: {
                    required: true,
                    name_Regex:true,
                    maxlength: 100,
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 11,
                    number: true
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    url:'{{ route('save.contact') }}',
                    type: "GET",
                    data: $('#contact_form').serialize(),
                    success: function( data ) {
                        // alert( data.success );
                        $('#msg').show();
                        $("#name").val("");
                        $("#phone").val("");
                    }
                });
                // form.submit();
                return false;
            },
        });
    });
    </script>
@endsection
