@extends('layouts.app')
@section('title','Team Detail')
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
                    <li><a href="{{route('team')}}">Our Team</a></li>
                    <li><span>Wiliam Brown</span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">Our Team</h2>
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
                    <div class="team-details-sec">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tm-img">
                                    <img src="https://via.placeholder.com/444x476" alt="" class="w-100">
                                </div>
                                <!--tm-img end-->
                            </div>
                            <div class="col-md-6">
                                <div class="team-m-info">
                                    <div class="tm-info">
                                        <h3>William Brown</h3>
                                        <span>Lawyer</span>
                                        <p>“My principle of work is to sincerely help people and solve their problems. I
                                            believe that a lawyer should combine several characteristics in order to be
                                            at a high level and remain committed to their work”</p>
                                        <ul class="social_links">
                                            <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                            <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                        </ul>
                                    </div>
                                    <!--tm-info end-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--team-details-sec end-->
                    <h2>Biography</h2>
                    <p>Maecenas id dui quis nisi placerat ornare vel quis libero. Ut ullamcorper diam non pre blandit
                        malesuada. Phasellus bibendum tincidunt placerat. Duis mollis placerat for in magna, id
                        convallis eros ultrices vitae. Maecenas at nisi orci. Integer fermentum from nisl neque,
                        fermentum molestie dui lacinia non. Nam vel diam at erat viverra lacinia. Morbi auctor, lectus
                        eu interdum efficitur, felis velit consequat odio, ac placerat press magna libero a leo. Orci
                        varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus
                        blandit sapien ut blandit bibendum. </p>
                    <p>Phasellus in neque nec mi porta congue. Integer placerat pretium arcu quis pulvinar. In id ligula
                        eu nisl eleifend tincidunt quis sed magna. Cras tristique odio sit amet vesti Curabitur in
                        lectus blandit, efficitur turpis a, imperdiet enim. Donec consequat vel at ultrices. Nullam
                        vitae vestibulum nibh.</p>
                    <div class="counter-section">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="counter-col">
                                    <h2><span class="count">21</span>%</h2>
                                    <span>charges dropped</span>
                                </div>
                                <!--counter-col end-->
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="counter-col">
                                    <h2><span class="count">82</span>%</h2>
                                    <span>countersuit filed</span>
                                </div>
                                <!--counter-col end-->
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="counter-col">
                                    <h2><span class="count">57</span>%</h2>
                                    <span>cases dismissed</span>
                                </div>
                                <!--counter-col end-->
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="counter-col">
                                    <h2><span class="count">77</span>%</h2>
                                    <span>cases won</span>
                                </div>
                                <!--counter-col end-->
                            </div>
                        </div>
                    </div>
                    <!--counter-section end-->
                    <div class="svs-posts">
                        <div class="section-title d-flex flex-wrap align-items-center">
                            <h2 class="h-title dark-clr mw-100">What do I specialize in</h2>
                        </div>
                        <!--section-title end-->
                        <div class="posts">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="post">
                                        <div class="post-thumbnail">
                                            <img src="https://via.placeholder.com/444x344" alt="" class="w-100">
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="service-details.html" title="">Judicial protection</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer semper
                                                metus mi, sit amet cursus ante viverra nec. Vivamus luctus, ipsum eget
                                                ornare convallis, urna at rutrum diam, eget tempus a magna fitam.
                                                Phasellus facilisis sapien eget suscipit lectus. </p>
                                            <a href="service-details.html" title="" class="btn-default">See more</a>
                                        </div>
                                    </div>
                                    <!--post end-->
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-md-6 col-sm-6">
                                    <div class="post">
                                        <div class="post-thumbnail">
                                            <img src="https://via.placeholder.com/444x344" alt="" class="w-100">
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="service-details.html" title="">Lawyer consulting</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer semper
                                                metus mi, sit amet cursus ante viverra nec. Vivamus luctus, ipsum eget
                                                ornare convallis, urna at rutrum diam, eget tempus a magna fitam.
                                                Phasellus facilisis sapien eget suscipit lectus. </p>
                                            <a href="service-details.html" title="" class="btn-default">See more</a>
                                        </div>
                                    </div>
                                    <!--post end-->
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="post">
                                        <div class="post-thumbnail">
                                            <img src="https://via.placeholder.com/444x344" alt="" class="w-100">
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="service-details.html" title="">Debt collection</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer semper
                                                metus mi, sit amet cursus ante viverra nec. Vivamus luctus, ipsum eget
                                                ornare convallis, urna at rutrum diam, eget tempus a magna fitam.
                                                Phasellus facilisis sapien eget suscipit lectus. </p>
                                            <a href="service-details.html" title="" class="btn-default">See more</a>
                                        </div>
                                    </div>
                                    <!--post end-->
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="post">
                                        <div class="post-thumbnail">
                                            <img src="https://via.placeholder.com/444x344" alt="" class="w-100">
                                        </div>
                                        <div class="post-info">
                                            <h4><a href="service-details.html" title="">Real estate lawyer</a></h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer semper
                                                metus mi, sit amet cursus ante viverra nec. Vivamus luctus, ipsum eget
                                                ornare convallis, urna at rutrum diam, eget tempus a magna fitam.
                                                Phasellus facilisis sapien eget suscipit lectus. </p>
                                            <a href="service-details.html" title="" class="btn-default">See more</a>
                                        </div>
                                    </div>
                                    <!--post end-->
                                </div>
                            </div>
                        </div>
                        <!--posts end-->
                    </div>
                    <div class="our-proptz">
                        <div class="proptz">
                            <h2 class="h-title">My skills</h2>
                            <div class="progres-sec">
                                <h5>Business law</h5>
                                <div class="progress">
                                    <div class="progress-bar" data-width="90" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                    <span>90%</span>
                                </div>
                            </div>
                            <!--progres-sec end-->
                            <div class="progres-sec">
                                <h5>Family law</h5>
                                <div class="progress">
                                    <div class="progress-bar" data-width="75" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                    <span>75%</span>
                                </div>
                            </div>
                            <!--progres-sec end-->
                            <div class="progres-sec">
                                <h5>Civil litigation</h5>
                                <div class="progress">
                                    <div class="progress-bar" data-width="88" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                    <span>88%</span>
                                </div>
                            </div>
                            <!--progres-sec end-->
                            <div class="progres-sec">
                                <h5>Traffic Accidents</h5>
                                <div class="progress">
                                    <div class="progress-bar" data-width="97" role="progressbar" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                    <span>97%</span>
                                </div>
                            </div>
                            <!--progres-sec end-->
                        </div>
                    </div>
                    <!--our-proptz end-->
                </div>
                <!--service-details end-->
            </div>
            <div class="col-xl-4">
                <div class="sidebar">
                    <div class="widget widget-services">
                        <h2 class="widget-title">Other employees</h2>
                        <ul>
                            <li><a href="#" title="">Sofia Martinez</a> </li>
                            <li><a href="#" title="">William Brown</a> </li>
                            <li><a href="#" title="">Anthony Harris</a> </li>
                            <li><a href="#" title="">David Thompson</a> </li>
                            <li><a href="#" title="">Kevin Johnson</a> </li>
                            <li><a href="#" title="">Land lawyer</a> </li>
                            <li><a href="#" title="">Elizabeth Lewis</a> </li>
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

@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
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
