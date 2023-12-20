@extends('layouts.app')
@section('title','Package Detail')
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
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('purchase.package')}}">Packages</a></li>
                    <li><span>{{@$packageDetail->package_name}}</span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">{{@$packageDetail->package_name}}</h2>
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->

<section class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-xl-8">
                <div class="page-details">
                    <img src="https://via.placeholder.com/634x462" alt="" class="w-100">

                    {{--<h2 class="page-title">{{@$packageDetail->package_name}}</h2>--}}
                    <h2 style="    font-size: 44px;">₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}</h2>
                    <p>{{@$packageDetail->package_desc}}</p>

                    @if(@$packageDetail->id == 1)

                    <h2>Let your loved ones access your original physical Will with our Advanced Will Location Registry.</h2>
                    <img src="https://via.placeholder.com/634x462" alt="" class="w-100">
                    <p>Like all important documents that relate to your property, your Will needs to be stored in a secure manner and at a location that is accessible and known. The location of your Will could be at a special place in your home, a bank locker, with a friend or with an Advocate/Lawyer. </p>
                    <p>Will & More provides a facility to register the location of your Will securely and confidentially and inform your loved ones of your Will location in the event of your passing.</p>
                    <p>The process to register the location of your Will and upload the Letter of Instructions is quick, simple and cost effective. You only need to fill in a few details about yourself, location of the Will and name three nominees, who would be provided with the location of your Will after your passing away.</p>

                    @endif

                    @if(@$packageDetail->id == 2)

                    <h2>Secure Your Legacy with our Online Will Creation module - Create Your Will from the Comfort of Your Own Home</h2>
                    <img src="https://via.placeholder.com/634x462" alt="" class="w-100">
                    <p>One of the main advantages of creating a Will online is the convenience it offers. Rather than having to schedule an appointment with a lawyer and go through the process in person, you can complete the process from the comfort of your own home. This can save you time and money, as well as making it more accessible for people who may have mobility or transportation issues.</p>
                    <p>Another advantage of online Will creation is the cost. Traditional Will creation can be expensive, especially if you hire a lawyer to draft your Will. We offer affordable and competitive pricing options, making it more accessible for people on a budget.</p>
                    <p>Our online Will creation services offer you a user-friendly and easy-to-use interface, which makes the process simple and straightforward. Our service offers step-by-step guidance and prompts to help you complete the process quickly and easily. To add value, we provide legal advice or attorney review to ensure that your Will is legally valid and meets legal requirements.</p>
                    <p>It's important to note that while online Will creation is a convenient and affordable option, it's not right for everyone. If you have a complex estate or unique circumstances, we offer the help of a lawyer or estate planning professional. Please contact our support and we will revert to you quickly</p>
                    <p>In conclusion, our online Will creation can be a great option for many people looking to plan their derivatives. It offers convenience, affordability, and user-friendly process.</p>

                    @endif

                    @if(@$packageDetail->id == 3)

                    <h2>Leave a Legacy of Instructions and Wishes to your loved ones with Our Letter of Instructions Service</h2>
                    <img src="https://via.placeholder.com/634x462" alt="" class="w-100">
                    <p>A letter of instructions, also known as a letter of wishes or memorandum of wishes, is a document that provides guidance and instructions to the executor of your will or to your loved ones regarding your final wishes and personal matters. It's not a legally binding document, but it can serve as a valuable guide for those who are carrying out your wishes after your passing.</p>
                    <p>A letter of instructions can cover a wide range of topics, such as funeral arrangements, organ donation, disposition of personal property, and final wishes for your pet. It can also include information about your personal and financial affairs, such as your bank account numbers, insurance policies, and other assets. This information can be particularly useful for your executor, as it can help them carry out your wishes more easily and efficiently.</p>
                    <p>It's important to note that a letter of instructions should not be used to make changes to your will, as any changes made to your will must be in writing and signed by you and two witnesses. A letter of instructions should also be kept separate from your will, as it may not be considered valid if it's found to be part of your will.</p>
                    <p>Another important point is that a letter of instructions should be updated regularly, as your wishes or personal information may change over time. It's a good idea to review and update your letter of instructions at least once a year, or whenever there is a significant change in your life, such as the birth of a child, marriage, or divorce.</p>
                    <p>In a nutshell, a letter of instructions is a valuable document that can provide guidance and instructions to your loved ones and executor regarding your final wishes and personal matters. It's not a legally binding document, but it can serve as a valuable guide for those who are carrying out your wishes after your passing. Keep it updated and separate from your will for best results.</p>

                    @endif

                    <div class="team-section">
                        <h2>Our best specialists will represent your interests</h2>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="team">
                                    <div class="team-thmb">
                                        <img src="{{asset('public/images/team/Rekha-Kuruvilla.png')}}" alt="" class="w-100">
                                    </div>
                                    <div class="team-info">
                                        <div class="team-text team-text2">
                                            <h3><a href="javascript:;" title="">Rekha Kuruvilla</a></h3>
                                            <span>Director at Will &amp; More</span>
                                            <p class="mt-15">Rekha Kuruvilla is passionate about
                                                providing an easy platform for people to
                                                write their Wills and secure the future of
                                                India.</p>
                                            
                                            <div class="moretext" style="display:none;">
                                                <p>Her background is in Non-Profit
                                                    Management, and she is very interested in
                                                    social innovations that help mitigate socio-
                                                    legal problems in communities.</p>
                                                <p>She has spent 21 years as a Partner and
                                                    Chief Operating Officer with Joby Mathew

                                                    &amp; Associates, responsible for business
                                                    development.</p>
                                            </div>
                                            <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <!--team end-->
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="team">
                                    <div class="team-thmb">
                                        <img src="{{asset('public/images/team/joseph-hadrian-bosco.png')}}" alt="" class="w-100">
                                    </div>
                                    <div class="team-info">
                                        <div class="team-text team-text2">
                                            <h3><a href="javascript:;" title="">Joseph Hadrian Bosco</a></h3>
                                            <span>Founder of Will &amp; More</span>
                                            <p class="mt-15">Mr Joseph Hadrian Bosco is the founding member of Will &amp; More.</p>
                                            
                                            <div class="moretext" style="display:none;">
                                            <p>He has a long legal and Indian Capital
                                                Markets history and was the MD &amp; CEO of
                                                a few stock Exchanges in India and abroad.
                                                He is a legal, Compliance and Regulatory
                                                Professional.</p>
                                            </div>
                                            <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                                        </div>
                                    </div>
                                </div>
                                <!--team end-->
                            </div>
                        </div>
                    </div>
                    <!--team-section end-->
                    <div class="our-proptz">
                        <div class="proptz mw-100">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progres-sec">
                                        <h5>Professionalism</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="90" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>90%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                    <div class="progres-sec">
                                        <h5>Persistence</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="75" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>75%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                    <div class="progres-sec">
                                        <h5>Composure</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="88" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>88%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                    <div class="progres-sec">
                                        <h5>Stress tolerance</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="97" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>97%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                </div>
                                <div class="col-md-6">
                                    <div class="progres-sec">
                                        <h5>Professionalism</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="90" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>90%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                    <div class="progres-sec">
                                        <h5>Persistence</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="75" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>75%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                    <div class="progres-sec">
                                        <h5>Composure</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="88" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>88%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                    <div class="progres-sec">
                                        <h5>Stress tolerance</h5>
                                        <div class="progress">
                                            <div class="progress-bar" data-width="97" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            <span>97%</span>
                                        </div>
                                    </div>
                                    <!--progres-sec end-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--our-proptz end-->
                </div>
                <!--service-details end-->
            </div>
            <div class="col-xl-4">
                <div class="sidebar">
                    <div class="widget widget-services">
                        <h2 class="widget-title">Other Packages</h2>
                        <ul>
                            @if(@$packages)
                            @foreach(@$packages as $package)
                            <li><a href="{{route('package.detail',[@$package->id])}}">{{@$package->package_name ? $package->package_name : '-'}}</a> </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <!--widget-services end-->
                </div>
                <!--sidebar end-->
            </div>
        </div>
    </div>
</section>
<!--page-content end-->

<section class="block">
    <div class="fixed-bg banner_img bg2"></div>
    <div class="container">
        <div class="section-title">
            <h2 class="h-title mw-100">Receive consultation</h2>
            <span>Contact us today for a friendly, no-obligation chat to discuss your Will.</span>
            <span>Complete the form below, and we’ll call you back. Monday to Friday, 10 am to 5
                pm.</span>
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
                    <div class="col-lg-5">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your name">
                        </div>
                        <!--form-group end-->
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*">
                        </div>
                        <!--form-group end-->
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
        <!--consulation-form end-->
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

        $('.moreless-button').click(function() {
        $(this).parent().find('.moretext').slideToggle();
        if ($(this).parent().find('.moreless-button').text() == "Read more") {
            $(this).text("Read less")
        } else {
            $(this).text("Read more")
        }
    }); 

    });
    </script>
@endsection
