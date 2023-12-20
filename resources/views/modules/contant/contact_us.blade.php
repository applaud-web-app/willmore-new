@extends('layouts.app')
@section('title','Contact Us')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<section class="pager-section banner_img">
    <div class="container">
        <div class="main-banner-content p-relative">
            @include('includes.social_links')
            <!--social-links end-->
            <div class="pager-content">
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    <li><span>Contact Us </span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">Contact Us</h2>
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->

<section class="block2">
    <div class="container">
        <div class="contact_section">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="contact_info">
                        <ul>
                            <li>
                                <span>
                                    <i class="flaticon-pin"></i>
                                </span>
                                <div class="ccn-info">
                                    <p>Office No 1111, Maker Chamber V Nariman Point, Mumbai 400 021</p>
                                </div>
                            </li>
                            {{-- <li>
                                <span>
                                    <i class="flaticon-clock"></i>
                                </span>
                                <div class="ccn-info">
                                    <p><span>Mon - Fri: </span> 10am to 5pm</p>
                                    <p><span>Saturday, Sunday: </span> Closed</p>
                                </div>
                            </li> --}}
                            <li>
                                <span>
                                    <i class="flaticon-phone"></i>
                                </span>
                                <div class="ccn-info">
                                    <p><a href="tel:+91 7777076298">+91 7777076298</a>

                                    </p>
                                </div>
                            </li>
                            <li>
                                <span>
                                    <i class="flaticon-email"></i>
                                </span>
                                <div class="ccn-info">
                                    <a href="mailto:assistance@willandmore.com" title="">assistance@willandmore.com</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--contact_info end-->
                </div>
                <div class="col-lg-8">
                    <div class="cnst-form">
                        <div class="section-title">
                            <h2 class="h-title dark-clr mw-100">Contact Us</h2>

                            <div id="msg" class="alert alert-success alert-dismissible" style="display: none;text-align: center;">
                                <span>Request Send Successfully</span>
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        </div>

                        <div class="consulation-form">
                            <form method="GET" name="contact_form" id="contact_form">
                                @csrf
                                <div class="response"></div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Your name">
                                        </div>
                                        <!--form-group end-->
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" required>
                                        </div>
                                        <!--form-group end-->
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group phncc-inpt">
                                                <div class="phonecode-sec contact_phcode">
                                                    <select class="input_form_login p_input rm_form_fild" name="phonecode" id="singleSelectExample">
                                                            @foreach($countrys as $phonecode)
                                                            <option value="{{$phonecode->phonecode}}" {{$phonecode->phonecode == 91 ? 'selected' : ''}}>+{{$phonecode->phonecode}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*">
                                        </div>
                                        <!--form-group end-->
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <textarea name="message" id="message" placeholder="Message"></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" name="form_type" id="form_type" value="CU" class="form-control">

                                    <div class="col-lg-2">
                                        <button type="submit" class="submit" >Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--cnst-form end-->
                </div>
            </div>
        </div>
        <!--contact_section end-->
    </div>
</section>
{{--
<section class="map-sec">
    <!-- <iframe
        src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
    </iframe> -->
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3774.1472905788787!2d72.82091666489886!3d18.92487353717476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sOffice%20No%201111%2C%20Maker%20Chamber%20V%20Nariman%20Point%2C%20Mumbai%20400097!5e0!3m2!1sen!2sin!4v1663915822297!5m2!1sen!2sin" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

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
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
{{-- <script src="{{asset('public/js/captcha.js')}}"></script> --}}
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
                email:{
                    email:true,
                    maxlength:80
                },
                message: {
                    required: true
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
                        $("#message").val("");
                        $("#email").val("");
                    }
                });
                // form.submit();
                return false;
            },
        });

        $(document).ready(function() {
        // Setting default configuration here or you can set through configuration object as seen below
            $.fn.select2.defaults = $.extend($.fn.select2.defaults, {
                allowClear: true, // Adds X image to clear select
                closeOnSelect: true, // Only applies to multiple selects. Closes the select upon selection.
                placeholder: 'Select...',
                minimumResultsForSearch: 15 // Removes search when there are 15 or fewer options
            });
        });

        $(document).ready(
        function () {

            // Single select example if using params obj or configuration seen above
            var configParamsObj = {
                placeholder: 'Select an option...', // Place holder text to place in the select
                minimumResultsForSearch: 3 // Overrides default of 15 set above
            };
            $("#singleSelectExample").select2(configParamsObj);
        });

    });
</script>
@endsection
