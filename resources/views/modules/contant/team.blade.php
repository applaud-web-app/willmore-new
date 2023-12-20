@extends('layouts.app')
@section('title','Team')
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
                    <li><span>Our Team</span></li>
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


<section class="block">
    <div class="container">
        <div class="section-title d-flex flex-wrap align-items-end">
            <h2 class="h-title dark-clr mw-40">Our Experts</h2>
            {{-- <p class="text-right"><a href="{{route('team')}}" title="" class="btn-default">Learn more about our team</a></p> --}}
        </div><!--section-title end-->
        <div class="team-section team_boxx_size">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/Rekha-Kuruvilla.png')}}" alt="" class="expert-img-size">
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
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/joseph-hadrian-bosco.png')}}" alt="" class="expert-img-size">
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
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/joby-mathew.png')}}" alt="" class="expert-img-size">
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
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div>
                {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/manoj-v-gorge.png')}}" alt="" class="expert-img-size">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Manoj V George</a></h3>
                                <span>The Legal Team</span>
                                <p class="mt-15">Manoj George is the founder of Newtons
                                    Law LLP and managing Partner of The Law
                                    Office of Georges (TLOG) which has a </p>

                                <div class="moretext" style="display:none;">
                                <p>Pan Indian presence and outside India through partners abroad.
                                    Manoj has experience in representing in
                                    Civil, Criminal, and Constitutional matters
                                    in the Supreme Court of India and various
                                    High Courts.</p>
                                <p>Manoj brings vast legal experience of
                                    Testamentary practice to Will &amp; More.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div> --}}
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/rohini-menon.png')}}" alt="" class="expert-img-size">
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
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/tanya-gupta.png')}}" alt="" class="expert-img-size">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Tanya Gupta</a></h3>
                                <span>Lawyer</span>
                                <p class="mt-15">Tanya Gupta completed her Masters of Law
                                    Degree (LLM) at the National Institute of
                                    Securities (NISM) </p>

                                <div class="moretext" style="display:none;">
                                <p>before joining Joby Mathew &amp; Associates.
                                    Tanya is passionate about Securities Law
                                    and Testamentary Law.</p>
                                </div>
                                <a href="javascript:;" class="readMore moreless-button" id="readMoreBtn">Read more</a>
                            </div>
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="team">
                        <div class="team-thmb">
                            <img src="{{asset('public/images/team/aditya-joby.png')}}" alt="" class="expert-img-size">
                        </div>
                        <div class="team-info">
                            <div class="team-text team-text2">
                                <h3><a href="javascript:;" title="">Aditya Joby</a></h3>
                                <span>Director of Will & More</span>
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
                            <ul class="social-links">
                                <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                            </ul>
                        </div>
                    </div><!--team end-->
                </div>
            </div>
        </div><!--team-section end-->
    </div>
</section>

{{-- <section class="block">
    <div class="container">
        <div class="section-title d-flex flex-wrap align-items-end">
            <h2 class="h-title dark-clr mw-40">Our Experts</h2>
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
</section> --}}

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

                        <div class="testi-info">
                            <h3>Priya Gupta</h3>
                            <p>“I have saved my Will Location and Letter of Instructions with Will &amp; More so that my
                                children do not have to suffer the anxiety and heartache that we had to go through.”</p>
                        </div>
                    </div>
                    <!--testimonial end-->
                </div>
                <div class="col-lg-6">
                    <div class="testimonial d-flex flex-wrap align-items-start">

                        <div class="testi-info">
                            <h3>Thomas Mathew</h3>
                            <p>“I have saved my Will Location details at Will &amp; More to save my family from the kind
                                of worries we had.”</p>
                        </div>
                    </div>
                    <!--testimonial end-->
                </div>

            </div>
        </div><!-- testimonial-slider end-->
    </div>
</section>



@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
<script>
$(document).ready(function() {

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
