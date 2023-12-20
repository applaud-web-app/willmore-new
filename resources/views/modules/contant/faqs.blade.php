@extends('layouts.app')
@section('title','Faq')
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
                    <div class="social-links">
                        <ul>
                            <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                        </ul>
                    </div><!--social-links end-->
                    <div class="pager-content">
                        <ul class="breadcrumb-list">
                            <li><a href="#" title="">Home</a></li>
                            <li><span>Faq</span></li>
                        </ul><!--breadcrumb end-->
                        <h2 class="page-title">Frequently Asked Questions</h2>
                    </div><!--pager-content end-->
                </div><!--main-banner-content end-->
            </div>
        </section><!--pager-section end-->

        <section class="block2">
            <div class="container">

                <div class="faqs-section">
                    <div class="section-title">
                        <h2 class="h-title dark-clr mw-100">Answers to frequently <br /> asked questions</h2>
                    </div><!--section-title end-->
                    <div class="row toggle">
                        <div class="col-lg-12">
                            <div class="togglee v2 new_togles_items">

                                @foreach(@$faqs as $faq)
                                <div class="toggle-item">
                                    <h2 class="active">{{@$faq->question}}</h2>
                                    <div class="content">
                                        <p>{{@$faq->answer}}</p>
                                    </div>
                                </div>
                                @endforeach

                                {{-- <div class="toggle-item">
                                    <h2>How long does it take to solve the problem?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <h2>If you don't solve my problem, what happens?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <h2>Can I get help on weekends or holidays?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <h2 class="active">How can I pay for your services?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <h2>How long does it take to solve the problem?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <h2>If you don't solve my problem, what happens?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <h2>Can I get help on weekends or holidays?</h2>
                                    <div class="content">
                                        <p>Phasellus mattis nisi eget dignissim dictum. Curabitur eget libero dignissim nisl auctor tincidunt. Nullam cursus mollis nisl, ac molis maximus tellus tempor quis. Morbi at felis quis sapien ultricies no hendrerit. Proin sit amet magna condimentum, tristique sapien at pharetra ac. Sed placerat laoreet enim, ac ullamcorper odio aliquet. </p>
                                    </div>
                                </div> --}}
                            </div><!--toggle end-->
                        </div>
                    </div>
                </div><!--faqs-section end-->
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
                                </div><!--form-group end-->
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*">
                                </div><!--form-group end-->
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <button type="submit" class="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div><!--consulation-form end-->
            </div>
        </section>

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
