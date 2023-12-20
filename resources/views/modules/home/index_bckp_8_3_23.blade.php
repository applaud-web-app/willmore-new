@extends('layouts.app')
@section('title','WillAndMore')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<section class="main-banner overlay">
    <div class="container">
        <div class="main-banner-content">
            <div class="social-links">
                <ul>
                    <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
            <div class="banner-text">
                {{-- <h2>Simple solution <br /> to complex <br /> questions</h2>  --}}
                <h2>Create a Will online in just a few simple steps</h2>
                <!--<a href="contact.html" title="">Receive consultation</a>-->
                <ul class="counter-row">
                    <li>
                        <h2><span class="count">250</span></h2>
                        <span>Online Wills created</span>
                    </li>
                    <li>
                        <h2><span class="count">50</span></h2>
                        <span>Letter of Instructions</span>
                    </li>
                    <li>
                        <h2><span class="count">150</span></h2>
                        <span>Will Location Registry service availed</span>
                    </li>
                    {{-- <li>
                        <h2><span class="count">77</span>%</h2>
                        <span>cases won</span>
                    </li> --}}
                </ul>
            </div>
            <div class="banner-img wow fadeInUp" data-wow-duration="1000ms">
                <img src="{{asset('public/images/home-header-img.png')}}" alt="" class="w-100">
            </div>
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--main-banner end-->

<section class="block">
    <div class="container">
        <div class="about-section">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="abt-img">
                        <img src="{{asset('public/images/video_thumb2.png')}}" alt="" class="w-100">
                        {{--<h2>History of our company</h2>--}}
                        {{--<iframe class="embed-responsive-item" width="100%" height="368px" src="{{asset('public/willandmore_video.mp4')}}"></iframe>--}}
                        <a href="{{asset('public/willandmore_video.mp4')}}" title="" class="play-btn html5lightbox"><i
                                class="fa fa-play"></i></a>
                    </div>
                    <!--abt-img end-->
                </div>
                <div class="col-lg-6">
                    <div class="about-text wow fadeInUp" data-wow-duration="1000ms">
                        <h2>About Us</h2>
                        <p>The goal of Will &amp; More is to secure your family’s future by ensuring that you have a
                            Will in place that records your final wishes and enables your estate to be distributed to
                            your family the way you would like it.</p>
                        <p>When you write a Will, you’ll also want to be sure that your family can find it easily when
                            you pass away, and so ensuring that your wishes can be carried out as you desire rather than
                            having them distributed purely as per the laws of succession.</p>
                        {{-- <p>Registering the location of your will with us also facilitates that desire.</p>
                        <p>Using our Will Location facility will help locate the will document so that your wishes, as per the will, are honoured.</p>
                        <p>Additionally, you may want to leave specific instructions to your loved ones about valuable items,
                            financial documents, insurance papers, pension papers, share certificates, mutual fund details, digital assets or even
                            certain specific relationship or religious ceremonies that you may want.</p>
                        <p>You can record the details of this information in a Letter of Instructions and store it with us safely, securely and confidentially.
                            This will only be communicated after your passing as per your prior instructions, or in exceptional circumstances such as debilitating
                            illness or disability, incapacitating you from acting in your own interest.</p>
                        <p>Your family and loved ones will then be spared the anguish and worry of not knowing the specific details of your assets.
                            It will be a smooth transition for them.</p> --}}
                        <a href="{{route('about_us')}}" title="" class="btn-default">See more</a>
                    </div>
                    <!--about-text end-->
                </div>
            </div>
        </div>
        <!--about-section end-->
    </div>
</section>
<!--sec-block end-->

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
                        <p>Create a Will online from the comfort of your own home, at a time that is convenient for you.
                        </p>
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
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="smpl-txt">
                        <h4>Why are we different?</h4>
                        <p>Unlike other online Will creation services, we have the legal expertise to both create your
                            Will and help you certify it with the required state-specific requirements. This ensures
                            that the document is legally valid and can be acted upon in the rare event of your passing
                            away. We are also committed to providing the best customer service possible, with a team of
                            experienced legal professionals available to answer your questions and address your
                            concerns.</p>
                        <p>Thanks to our unique combination of legal services, adherence to stringent Will privacy norms
                            and customer care, you can rest assured that your Will is created with the utmost attention
                            to detail and accuracy. We have the expertise, experience, and dedication to make sure that
                            your final wishes are respected, and your estate is secured.</p>
                    </div>
                    <!--smpl-txt end-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="service-col wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">
                        <h2>03<span>.</span></h2>
                        <h4>Accuracy</h4>
                        <p>Willandmore.com uses simple questionnaires and prompts to ensure that all necessary
                            information is included in the document.</p>
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
                        <p>Your Will contains sensitive and personal financial information. willandmore.com is
                            absolutely secure and offers complete privacy.</p>
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

<section class="block">
    <div class="container">
        <div class="section-title sec-big-ttl d-flex flex-wrap">
            <h2 class="h-title dark-clr w-100">What can we help you with</h2>

            <p class="w-100">WillandMore provides you with comprehensive Will creation options to cover differen
                aspects of your estate. These include a Will that focuses on passing down a particular
                asset, or a Will that divides your estate between multiple beneficiaries. It could also include
                Will that allows you to make separate provisions for different family members. Besides our
                Letter of Instructions service and Will location Registry will enable you to make sure that
                your wishes are carried out in accordance with your wishes.
            </p>
        </div>
        <!--section-title end-->
        <div class="posts">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="post-thumbnail">
                            <img src="{{asset('public/images/will_creation.png')}}" alt="" class="w-100">
                        </div>
                        <div class="post-info">
                            <div class="post-box">
                                <h4><a href="{{route('service_detail',1)}}" title="">
                                    @if(@$packages && @$packages[0])
                                    {{@$packages[0]->package_name}}
                                    @else
                                    Online Will Creation
                                    @endif
                                </a></h4>
                                <p>Write your Will with our online templates.</p>
                                <p>If you’d like a Custom Will, we’ll help you craft a Will to meet your specific
                                    situation.
                                </p>
                            </div>
                            <a href="{{route('service_detail',1)}}" title="" class="btn-default mr-3">See more</a>
                            @if(!Auth::check())
                            <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                            @endif
                        </div>
                    </div>
                    <!--post end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="post-thumbnail">
                            <img src="{{asset('public/images/will_location.png')}}" alt="" class="w-100">
                        </div>
                        <div class="post-info">
                            <div class="post-box">
                                <h4><a href="{{route('service_detail',2)}}" title="">
                                    @if(@$packages && @$packages[1])
                                    {{@$packages[1]->package_name}}
                                    @else
                                    Will Location Registry
                                    @endif
                                </a>
                                </h4>
                                <p>Register and store your Will Location securely so your loved ones can find it.</p>
                                <p>We’ll help you find the location of your loved one’s Will through our Search service
                                </p>
                            </div>
                            <a href="{{route('service_detail',2)}}" title="" class="btn-default mr-3">See more</a>
                            @if(!Auth::check())
                            <a href="javascript:;" class="purchase_btn purchasePackage" data-toggle="modal" data-target="#myModal" >Buy</a>
                            @endif
                        </div>
                    </div>
                    <!--post end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post">
                        <div class="post-thumbnail">
                            <img src="{{asset('public/images/will_loi.png')}}" alt="" class="w-100">
                        </div>
                        <div class="post-info">
                            <div class="post-box">
                                <h4><a href="{{route('service_detail',3)}}" title="">
                                    @if(@$packages && @$packages[2])
                                    {{@$packages[2]->package_name}}
                                    @else
                                    Letter of Instructions
                                    @endif</a></h4>
                                <p>Leave important information for your loved ones, securely and confidentially with us.
                                </p>
                            </div>
                            <a href="{{route('service_detail',3)}}" title="" class="btn-default mr-3">See more</a>
                            @if(!Auth::check())
                            <a href="javascript:;" class="purchase_btn purchasePackage" data-toggle="modal" data-target="#myModal" >Buy</a>
                            @endif
                        </div>
                    </div>
                    <!--post end-->
                </div>

    </div>
    </div>
    <!--posts end-->
    </div>
</section>

<section class="block">
    <div class="fixed-bg banner_img bg2"></div>
    <div class="container">
        <div class="section-title">
            <h2 class="h-title mw-100">Receive consultation</h2>
            <span>Contact us today for a friendly, no-obligation chat to discuss your Will.</span>
            <span>Complete the form below, and we’ll call you back. Monday to Friday, 10 am to 5
                pm.</span>
        </div>

        <div id="msg" class="alert alert-success alert-dismissible"
            style="display: none;text-align: center;max-width: 930px;">
            <span>Consultation Request Send Successfully</span>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>

        <!--section-title end-->
        <div class="consulation-form">
            <form class="wow fadeInUp" data-wow-duration="1000ms" method="GET" name="contact_form" id="contact_form">
                @csrf
                <input type="hidden" name="form_type" value="C" id="form_type" class="form-control">

                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your name"
                                required>
                        </div>
                        <!--form-group end-->
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone*"
                                required>
                        </div>
                        <!--form-group end-->
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <button type="submit" class="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
        <!--consulation-form end-->
    </div>
</section>

<section class="block">
    <div class="container">
        <div class="section-title d-flex flex-wrap align-items-end">
            <h2 class="h-title dark-clr mw-40">Our Experts</h2>
            <p class="text-right"><a href="{{route('team')}}" title="" class="btn-default">Learn more about our team</a>
            </p>
        </div>
        <!--section-title end-->
        <div class="team-section">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/joby-mathew.png')}}" alt="" class="w-100">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Joby Mathew</a></h3>
                                <span>Lawyer</span>
                                <p class="mt-15">Joby Mathew brings vast experience to Will
                                    &amp; More in advising corporate clients on
                                    succession planning.</p>

                                <div class="moretext" style="display:none;">
                                <p>His unique combination of regulatory,
                                    business and legal experience brings a
                                    unique insight to Will making in India.</p>
                                <p>He has over 22 years of practice as a lawyer
                                    specialising in laws relating to the Capital
                                    markets in India, combined with experience
                                    as an in-house legal counsel of a Bank,
                                    Legal Officer at Securities Exchange Board
                                    of India (SEBI) and Senior Associate at J.
                                    Sagar Associates, a Leading Law firm in
                                    India.</p>
                                <p>He is the founding partner of Joby Mathew &amp;
                                    Associates and has represented hundreds of
                                    Indian capital market participants including
                                    business houses, stocker brokers, investment
                                    bankers, private equity funds, venture
                                    capitals, collective investment schemes, and
                                    regulatory bodies.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!--team end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/manoj-v-gorge.png')}}" alt="" class="w-100">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Manoj V George</a></h3>
                                <span>The Legal Team</span>
                                <p class="mt-15">Manoj George is the founder of Newtons
                                    Law LLP and managing Partner of The Law
                                    Office of Georges (TLOG) which has a Pan
                                    Indian presence and outside India through</p>

                                <div class="moretext" style="display:none;">
                                <p>partners abroad. Manoj has experience in representing in
                                    Civil, Criminal, and Constitutional matters
                                    in the Supreme Court of India and various
                                    High Courts.</p>
                                <p>Manoj brings vast legal experience of
                                    Testamentary practice to Will &amp; More.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!--team end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/rohini-menon.png')}}" alt="" class="w-100">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Rohini Menon</a></h3>
                                <span>Lawyer</span>
                                <p class="mt-15">Advocate Rohini Menon has more than 25
                                    years of experience as a lawyer handling
                                    drafting and registration of documents.</p>

                                <div class="moretext" style="display:none;">
                                <p>She was instrumental in drafting Wills,
                                    Trust deeds and providing legal opinions for
                                    complex legal issues related to succession
                                    law in India.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                        </div>
                    </div>
                    <!--team end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/tanya-gupta.png')}}" alt="" class="w-100">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Tanya Gupta</a></h3>
                                <span>Lawyer</span>
                                <p class="mt-15">Tanya Gupta completed her Masters of Law
                                    Degree (LLM) at the National Institute of
                                    Securities (NISM) before joining Joby
                                    Mathew &amp; Associates.</p>

                                <div class="moretext" style="display:none;">
                                <p>Tanya is passionate about Securities Law
                                    and Testamentary Law.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/aditya-joby.png')}}" alt="" class="w-100">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Aditya Joby</a></h3>
                                <span>Director at Will & More</span>
                                <p class="mt-15">Aditya Joby is in his final year at Jindal
                                    Global Law school and assists the Will &amp;
                                    More legal team with legal research and
                                    drafting.</p>

                                <div class="moretext" style="display:none;">
                                <p>He is a keen student of Testamentary and
                                    Securities Law.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--team-section end-->
    </div>
</section>

<section class="block">
    <div class="fixed-bg banner_img bg3"></div>
    <div class="container">
        <div class="section-title testimonial-title">
            <h2 class="h-title mw-40">Check out our customer reviews</h2>
        </div>
        <!--section-titlee end-->
        <div class="testimonials home-testimonial">
            <div class="row testi-carousel">
                <div class="col-lg-6">
                    <div class="testimonial d-flex flex-wrap align-items-start">
                        {{--<div class="testi-thumb">
                            <img src="https://via.placeholder.com/77x77" alt="">
                        </div>--}}
                        <div class="testi-info">
                            <h3>Priya Gupta</h3>
                            <p>“I have saved my Will Location and Letter of Instructions with Will &amp; More so that my children do not have to suffer the anxiety and heartache that we had to go through.”</p>
                        </div>
                    </div>
                    <!--testimonial end-->
                </div>
                <div class="col-lg-6">
                    <div class="testimonial d-flex flex-wrap align-items-start">
                    {{--<div class="testi-thumb">
                            <img src="https://via.placeholder.com/77x77" alt="">
                        </div>--}}
                        <div class="testi-info">
                            <h3>Thomas Mathew</h3>
                            <p>“I have saved my Will Location details at Will &amp; More to save my family from the kind of worries we had.”</p>
                        </div>
                    </div>
                    <!--testimonial end-->
                </div>

            </div>
        </div><!-- testimonial-slider end-->
    </div>
</section>

<section class="block">
    <div class="container">
        <div class="section-title d-flex flex-wrap align-items-end">
            <h2 class="h-title dark-clr mw-40">Our Blog</h2>
            <p class="text-right"><a href="{{route('blog')}}" title="" class="btn-default">Read more blogs</a></p>
        </div>
        <!--section-title end-->
        <div class="blog-posts">
            <div class="row">
                {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-post-lg overlay wow slideInLeft" data-wow-duration="1000ms">
                        <img src="https://via.placeholder.com/444x573" alt="" class="w-100">
                        <div class="figcaption">
                            <h4>Business</h4>
                            <h2><a href="blog-single.html" title="">How to file for bankruptcy of your company</a></h2>
                            <span>15 Jule 2019</span>
                        </div>
                    </div>
                    <!--post-lg end-->
                </div> --}}

                @if(count(@$letestblog)>0)
                @foreach(@$letestblog as $blog)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-post">
                        <div class="blog-thumbnail home_blog_wid black_bg">
                            @if(@$blog->image)
                            <img src="{{url('storage\app\blog_cata_img')}}/{{ @$blog->image }}" alt="" class="img-size">
                            @else
                            <img src="{{asset('public/images/logo.png')}}" alt="" class="img-size">
                            @endif
                        </div>
                        <div class="blog-info blog_wid home_blog_cont_wid">
                            <h4>{{ @$blog->getBlogCata->category }}</h4>
                            <h2>
                                <a href="{{route('blog_details',['blog_slug'=>@$blog->blog_slug])}}" title="">
                                    @if(strlen(@$blog->title)>55)
                                    {!! str_limit(strip_tags(@$blog->title), 55) !!}
                                    @else
                                    {!! @$blog->title !!}
                                    @endif
                                </a>
                            </h2>
                            <span>{{ @$blog->created_at?date('j F Y',strtotime(@$blog->created_at)):'' }}</span>
                        </div>
                    </div>
                    <!--blog-post end-->
                </div>
                @endforeach
                @endif

                {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-post">
                        <div class="blog-thumbnail">
                            <img src="https://via.placeholder.com/444x287" alt="" class="w-100">
                        </div>
                        <div class="blog-info">
                            <h4>Business</h4>
                            <h2><a href="blog-single.html" title="">How to survive a business pandemic.
                                    Recommendations</a></h2>
                            <span>18 April 2019</span>
                        </div>
                    </div>
                    <!--blog-post end-->
                </div> --}}
            </div>
        </div>
        <a href="{{route('blog')}}" title="" class="purchase_btn more_blogs">More Blogs</a>
        <!--posts end-->
    </div>
</section>
<!--blog-posts-end-->
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog subscribe_modal">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">In order to purchase this package you need to sign up/login.</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <a href="{{route('login')}}" class="btn mod-red">Login</a>
        <a href="{{route('register')}}" class="btn mod-black">Signup</a>
      </div>

    </div>
  </div>
</div>
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
    $(".content").hide();
    $.validator.addMethod("name_Regex", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Name must contain only letters");

    $('#contact_form').validate({
        rules: {
            name: {
                required: true,
                name_Regex: true,
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
                url: '{{ route('save.contact') }}',
                type: "GET",
                data: $('#contact_form').serialize(),
                success: function(data) {
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


// $('.readMore').click(function(){
//     $(this).parent().find('.completeDesc').css('display',"inline-block");
//     $(this).css('display',"none");
//     //$(this).parent().find('.readMore').css('display',"none");
// });

// $('.readLess').click(function(){
//     $(this).parent().parent().find('.readMore').css('display',"inline-block");
//     $(this).parent().find('.completeDesc').css('display',"none");
//     $(this).parent().css('display',"none");
// });




});
</script>
@endsection
