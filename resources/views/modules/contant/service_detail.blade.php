@extends('layouts.app')
@section('title','Service Detail')
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
                    <li><a href="{{route('services')}}" title="">Services</a></li>
                    <li><span>{{@$packageDetail ? @$packageDetail->package_name : '-'}}</span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">{{@$packageDetail ? @$packageDetail->package_name : '-'}} @if(@$packageDetail->id == 5) (Living Will) @endif</h2>
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
            <div class="col-xl-12">
                <div class="page-details page-full">


                    @if(@$packageDetail->id == 2)

                    <h2 class="h2-full">Let your loved ones access your original physical Will with our Advanced Will Location Registry.</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{asset('public/images/will2.png')}}" alt="" class="w-100">
                        </div>
                        <div class="col-lg-6">
                        <div class="service-price">
                                <div class="">
                                    <h2>₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}
                                        <span class="pric_tabbb"> for 5 years  + GST</span></h2>
                                    @if(!Auth::check())
                                        <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                    @else
                                    <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}"  data-id="{{@$packageDetail->id}}" >Buy</a>
                                    @endif
                                </div>
                            </div>
                        <p>Like all important documents that relate to your property, your Will needs to be stored in a secure manner and at a location that is accessible and known. The location of your Will could be at a special place in your home, a bank locker, with a friend or with an Advocate/Lawyer. </p>
                        <p>Will & More provides a facility to register the location of your Will securely and confidentially and inform your loved ones of your Will location in the event of your passing.</p>
                        <p>The process to register the location of your Will and upload the Letter of Instructions is quick, simple and cost effective. You only need to fill in a few details about yourself, location of the Will and name three nominees, who would be provided with the location of your Will after your passing away.</p>
                        </div>
                    </div>


                    @endif

                    @if(@$packageDetail->id == 1)

                    <h2 class="h2-full">Secure Your Legacy with our Online Will Creation module - Create Your Will from the Comfort of Your Own Home</h2>

                    <div class="row">
                        <div class="col-xl-6">
                            <img src="{{asset('public/images/will1.png')}}" alt="" class="w-100">
                        </div>
                        <div class="col-xl-6">
                            <div class="service-price">
                                <div class="">
                                    <h2>₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}
                                        <span class="pric_tabbb"> + GST</span></h2>
                                    @if(!Auth::check())
                                        <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                    @else
                                    <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}"  data-id="{{@$packageDetail->id}}" >Buy</a>
                                    @endif
                                </div>
                            </div>
                        <p>One of the main advantages of creating a Will online is the convenience it offers. Rather than having to schedule an appointment with a lawyer and go through the process in person, you can complete the process from the comfort of your own home. This can save you time and money, as well as making it more accessible for people who may have mobility or transportation issues.</p>
                        <p>Another advantage of online Will creation is the cost. Traditional Will creation can be expensive, especially if you hire a lawyer to draft your Will. We offer affordable and competitive pricing options, making it more accessible for people on a budget.</p>
                        <p>Our online Will creation services offer you a user-friendly and easy-to-use interface, which makes the process simple and straightforward. Our service offers step-by-step guidance and prompts to help you complete the process quickly and easily. To add value, we provide legal advice or attorney review to ensure that your Will is legally valid and meets legal requirements.</p>
                        </div>
                    </div>

                    <p>It's important to note that while online Will creation is a convenient and affordable option, it's not right for everyone. If you have a complex estate or unique circumstances, we offer the help of a lawyer or estate planning professional. Please contact our support and we will revert to you quickly</p>
                        <p>In conclusion, our online Will creation can be a great option for many people looking to plan their derivatives. It offers convenience, affordability, and user-friendly process.</p>

                    @endif

                    @if(@$packageDetail->id == 3)

                    <h2 class="h2-full">Leave a Legacy of Instructions and Wishes to your loved ones with Our Letter of Instructions Service</h2>

                    <div class="row">
                        <div class="col-xl-6">
                            <img src="{{asset('public/images/will3.png')}}" alt="" class="w-100">
                        </div>
                        <div class="col-xl-6">
                        <div class="service-price">
                                <div class="">
                                    <h2>₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}
                                        <span class="pric_tabbb"> for 5 years  + GST</span></h2>
                                    @if(!Auth::check())
                                        <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                    @else
                                    <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}"  data-id="{{@$packageDetail->id}}" >Buy</a>
                                    @endif
                                </div>
                            </div>

                        <p>It may happen that you become disabled and incapacitated due to an accident or illness such as Alzheimer’s or Parkinson’s.
                            In such an unfortunate event, you may want to leave specific instructions to your loved ones about valuable items,
                            financial documents, insurance papers, pension papers, share certificates, mutual fund details, digital assets and
                            ways to access and use them or even certain specific relationship or religious ceremonies that you may want.</p>

                        <p>You can record the details of this information in a Letter of Instructions and store it with us safely, securely and confidentially.
                            This will only be communicated to your nominees, after they provide us with a medical certificate.</p>

                        </div>
                    </div>
                    <p>Another important point is that a letter of instructions should be updated regularly, as your wishes or personal
                        information may change over time. It's a good idea to review and update your Will as well as the letter of
                        instructions at least once a year, or whenever there is a significant change in your life, such as the birth of a
                        child, marriage, or divorce.</p>

                    @endif

                    @if(@$packageDetail->id == 4)

                        <h2 class="h2-full">Protect Your Future Today: Create Your Will, Register Its Location, and Draft a Letter of Instruction; all rolled into one</h2>

                        <div class="row">
                            <div class="col-xl-6">
                                <img src="{{asset('public/images/lagacy_main.png')}}" alt="" class="w-100">
                            </div>
                            <div class="col-xl-6">
                            <div class="service-price">
                                    <div class="">
                                        <h2>₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}
                                            <span class="pric_tabbb"> for 5 years  + GST</span></h2>
                                        @if(!Auth::check())
                                            <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                        @else
                                        <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}"  data-id="{{@$packageDetail->id}}" >Buy</a>
                                        @endif
                                    </div>
                                </div>

                            <p>At Willandmore.com, we offer “Legacy Guardian” - a bundle of services that includes online will creation, will location registry, and letter of instruction services. By opting for this bundle, individuals can save money compared to purchasing each service separately, and create a comprehensive estate plan that ensures their legacy is protected.</p>

                            <p>Creating a Will online is a quick and easy process that can be done from the comfort of one's own home. Our online Will creation service guides individuals through the process of creating a legally binding Will that reflects their wishes and protects their assets.</p>

                        <p>Our Will location registry service provides a secure and reliable way to store and locate important estate planning documents. By registering the location of these documents with a trusted third party, individuals</p>

                            </div>
                        </div>
                        <p>can ensure that their loved ones can easily access these documents when they are needed most.</p>
                        <p>Our letter of instruction service provides a way for individuals to communicate their wishes and provide guidance to their loved ones in the event of their incapacity or death. These letters can provide instructions on a wide range of matters, including funeral arrangements, the distribution of personal property, and the care of pets.</p>

                        <p>By combining these services, individuals can create a comprehensive estate plan that not only ensures their legacy is protected but also provides peace of mind and security for themselves and their loved ones. At Willandmore.com, we are committed to providing reliable and ethical services that help our clients achieve their estate planning objectives. Buy the Legacy Guardian package today and save a whopping 20% on our products /services.</p>

                        @endif

                        @if(@$packageDetail->id == 5)

                            <h2 class="h2-full">Protect Your Healthcare Preferences and Legacy using willandmore.com's Advance Medical Directive Service.</h2>

                            <div class="row">
                                <div class="col-xl-6">
                                    <img src="{{asset('public/images/consultance_main.png')}}" alt="" class="w-100">
                                </div>
                                <div class="col-xl-6">
                                <div class="service-price">
                                        <div class="">
                                            <h2>₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}
                                                <span class="pric_tabbb"> + GST</span></h2>
                                            @if(!Auth::check())
                                                <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                            @else
                                            <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}"  data-id="{{@$packageDetail->id}}" >Buy</a>
                                            @endif
                                        </div>
                                    </div>

                                <p>An Advance Medical Directive is a legal document that specifies an individual's healthcare preferences and appoints a trusted individual to make medical decisions on their behalf, should they become unable to do so themselves. At WillandMore.com, we understand the importance of planning for unexpected medical events that may arise in the future. That's why we offer Advance Medical Directive services to help our clients make informed decisions about their healthcare and ensure their wishes are respected in the event they become incapacitated.</p>

                                <p>Our Advance Medical Directive service allows you to create a legally binding document that reflects your healthcare preferences and appoints a trusted individual to make medical decisions on your behalf. Our team of experienced estate planning professionals work closely with you to understand your unique circumstances and healthcare goals, and to</p>

                                </div>
                            </div>

                            <p>provide guidance on the legal and financial implications of your decisions.</p>
                            <p>We understand that creating an Advance Medical Directive can be an emotional and challenging process, which is why we prioritize clear and effective communication and work to provide you with the support and guidance you need throughout the process. In addition to our personalized Advance Medical Directive service, WillandMore.com also provides you with a template to create your Advance Medical Directive on your own, if you prefer. This template is easy to use and helps you create a legally binding document that reflects your healthcare preferences and appoints a trusted individual to make medical decisions on your behalf.</p>

                            <p>By using our Advance Medical Directive service or our template, you can have peace of mind knowing that your healthcare preferences will be respected in the event of an unexpected medical event. </p>

                            <p>willandmore.com will assist you in facilitating the filing of the required legal documents and forward it to the appropriate municipal committees to further your proposal of choosing the desired Advance Medical Directive option.</p>

                            <p>Contact WillandMore.com today to learn more about our Advance Medical Directive services and how we can help you secure your future.</p>

                        @endif

                        @if(@$packageDetail->id == 6)

                            <h2 class="h2-full">Expert Estate Planning Consulting: Personalized Services to Help You Secure Your Legacy at willandmore.com</h2>

                            <div class="row">
                                <div class="col-xl-6">
                                    <img src="{{asset('public/images/amd_main.png')}}" alt="" class="w-100">
                                </div>
                                <div class="col-xl-6">
                                <div class="service-price">
                                        <div class="">
                                            <a href="{{route('contact_us')}}" class="purchase_btn ml-0">Contact us</a>
                                        </div>
                                    </div>

                                <p>At Willandmore.com, we understand that estate planning can be a complex and sometimes overwhelming process, which is why we offer more than just an exhaustive online tool for creating a will. We also provide personalized consulting services to help our clients navigate the estate planning process and make informed decisions about their assets, beneficiaries, and other important matters.</p>

                                <p>Our consulting services are designed to provide clients with a comprehensive understanding of the legal and financial implications of their decisions, as well as expert guidance on how to create an estate plan that meets their specific needs and goals. We work closely with our clients to understand their unique circumstances and priorities, and we provide clear and concise explanations of the various options available to them.</p>

                                </div>
                            </div>

                            <p>Whether you need help selecting executors and beneficiaries, drafting powers of attorney, or creating a trust, our team of experienced estate planning professionals is here to help. We are committed to providing personalized, ethical, and reliable consulting services that help our clients achieve peace of mind and security for their loved ones.</p>

                            <p>If you are looking for expert guidance and support in creating an estate plan that meets your unique needs and goals, Willandmore.com is here to help. Contact us today to learn more about our personalized consulting services and how we can help you achieve your estate planning objectives.</p>

                        @endif

                        @if(@$packageDetail->id == 8)

                            <h2 class="h2-full">Write a Will</h2>

                            <div class="row">
                                <div class="col-xs-12">
                                    <p>Will writing is an important step, without which your financial planning is incomplete. A properly written Will, can distribute your assets as per your wishes, and not the laws of succession. Periodic revisions of the Will ensure that changes in your financial situations, marital status and such other details are reflected in your Will. Through a Will, you can develop a financial plan which benefits the loved ones you leave behind.</p>
                                    <p class="mb-4">A few things to remember while writing your Will:</p>
                                </div>
                                <div class="col-xl-6">
                                    <div class="service-price">
                                        <div class="">
                                            <h2>₹ {{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}
                                                <span class="pric_tabbb">  + GST</span></h2>
                                            @if(!Auth::check())
                                                <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                            @else
                                            <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$packageDetail->package_price ? $packageDetail->package_price : '0.00'}}"  data-id="{{@$packageDetail->id}}" >Buy</a>
                                            @endif
                                        </div>
                                    </div>
                                    <ul style="list-style-type:disc;">
                                        <li class="mb-4 text-black-50">A Will can be handwritten or typed; however, a typed Will is preferred to a handwritten one because of better readability.</li>
                                        <li class="mb-4 text-black-50" >A Will need not be written/typed on a Stamp paper; you can prepare your Will using a good quality white paper of A4 size.</li>
                                        <li class="mb-4 text-black-50">A Will can be written or typed in any language.</li>
                                        <li class="mb-4 text-black-50">A Will should be written while you are of sound mind.</li>
                                        <li class="mb-4 text-black-50">A Will should be duly witnessed by at least 2 persons who should be expected to outlive you.</li>
                                        <li class="mb-4 text-black-50">A Will should include your personal details, details of the assets/property, details of the persons to whom you wish to leave your assets/property, name an executor to give effect to your desires as expressed in the Will and details of witnesses.</li>
                                    </ul>
                                </div>
                                <div class="col-xl-6">
                                    <img src="{{asset('public/images/will-write.jpg')}}" alt="" class="w-100">
                                </div>
                                <div class="col-xs-12">
                                    <p>We are providing five types of Will templates to those who buy Will templates for Rs. 1500/- +GST. You can choose the type of Will template as per your requirement and write your own Will following the instructions in the Will writing guidelines provided along with each template.</p>
                                </div>
                                <div class="col-xs-12">
                                    <p>If you need help to prepare a custom-made Will, or a reading of your Will by a lawyer to ensure the correctness of the Will, please write to us at assistance@willandmore.com. Our legal team Will get in touch with you to understand your needs and help you.</p>
                                </div>
                               
                            </div>

                        @endif


                    @if(@$packageDetail->id == 9)

                        <h2 class="h2-full">Will Location Search</h2>

                        <div class="row">
                            <div class="col-xl-6">
                                <p>Will & More provides a facility to search for Locations of Wills of the deceased if the location of his/her Will has been registered with Will & More. Anyone can search for the Will locations as well as the "Letter of Instructions" through the website after providing a copy of the death certificate of the deceased and identity proof of the searcher.</p>
                                <p>If the search result is positive and there is a Will location registered with us we will disclose the location of the Will of the deceased person and provide the letter of instructions to the person/s named as Nominees by the deceased at the time of registration or any changes to the nominees made thereafter. We charge Rs 2500/- + GST as the search fee.</p>
                                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#serviceModal" class="btn btn-primary">SEARCH</a>
                            </div>
                            <div class="col-xl-6">
                                <img src="{{asset('public/images/will-location-search.jpg')}}" alt="" class="w-100">
                            </div>
                          
                        </div>

                    @endif

                    <div class="team-section team_boxx_size">
                        <h2>Our experts will guide and support you should you need further assistance</h2>
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
                        </div>
                    </div><!--team-section end-->
                    {{-- <div class="team-section">
                        <h2>Our experts will guide and support you should you need further assistance</h2>
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
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
                            <div class="col-md-3 col-sm-6">
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
                            <div class="col-md-3 col-sm-6">
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
                            <div class="col-md-3 col-sm-6">
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
                        </div>
                    </div> --}}
                    <!--team-section end-->

                </div>
                <!--service-details end-->
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


<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form method="post" action="{{url('will-enquiry-contact')}}" id="enquiry_frm" name="enquiry_frm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Will Location Search</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body login_rm02 w-100" style="max-width: 100%;">
                    <div class="alert alert-success" role="alert" id="alert-pop" style="display: none;">
                            Will search location enquiry has been sent to customer service successfully. We will respond to you soon.
                      </div>
                    <div class="form-group">
                        <label>Name <span>*</span></label>
                        <input type="text" class="rm_form_fild" placeholder="Enter Here" id="enq_name" name="name" value="" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span>*</span></label>
                        <input type="email" class="rm_form_fild" placeholder="Enter Here" id="enq_email" name="email" value="" maxlength="80" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number <span>*</span></label>
                        <input type="number" class="rm_form_fild" placeholder="Enter Here" id="enq_mobile_number" name="mobile_number" value="" maxlength="12" required>
                    </div>
                    <div class="form-group">
                        <label>Message <span>*</span></label>
                        <textarea type="text" class="rm_form_fild" placeholder="Enter Here" rows="5" name="message" id="enq_message" value="" maxlength="500" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="save_changes" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
  </div>


@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@include('includes.toaster')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

    async function sendEnquiry(url = "", data = {}) {
        const response = await fetch(url, {
            method: "POST", 
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
            "Content-Type": "application/json",
            '_token': '{{csrf_token()}}',
            },
            body: JSON.stringify(data),
        });
        return response.json();
    }

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

        $('#enquiry_frm').validate({
            rules: {
            },
            submitHandler: function(form,e) {
                e.preventDefault();
                var elem = document.getElementById('save_changes');
                elem.setAttribute('disabled','disabled');
                elem.innerText = 'Processing...';
                var name = document.getElementById('enq_name').value;
                var email = document.getElementById('enq_email').value;
                var mobile_number = document.getElementById('enq_mobile_number').value;
                var message = document.getElementById('enq_message').value;
                sendEnquiry("{{url('will-enquiry-contact')}}", { name : name,email:email,mobile_number:mobile_number,message:message,"_token":"{{csrf_token()}}" }).then((data) => {
                       if(data.s==1){
                            document.getElementById('alert-pop').style.display = 'block';
                            document.getElementById('enq_name').value = '';
                            document.getElementById('enq_email').value = '';
                            document.getElementById('enq_mobile_number').value = '';
                            document.getElementById('enq_message').value = '';
                            elem.removeAttribute('disabled','disabled');
                            elem.innerText = 'Save';
                            setTimeout(() => {
                                document.getElementById('alert-pop').style.display = 'none';
                            }, 5000);
                       }
                });
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
<script>
  $(document).ready(function(){
    $('.purchasePackage').click(function(e){
            var id = $(this).data('id');
            var pay_amount = $(this).data('amount');
            totalAmount = pay_amount*100;
            totalAmount  = Math.floor(totalAmount*100)/100;
            Swal.fire({
                    title: 'Do you want to purchase this package ? ',
                    icon: 'success',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //window.location.href ="{{url('buy-package')}}/"+id;
                        var reqData1 = {
                                        'jsonrpc' : '2.0',
                                        '_token' : '{{csrf_token()}}',
                                        'totalAmount'           : totalAmount,
                                        'package_id'            : id,
                                        'currency_id'           : 1,
                                    };
                        $.ajax({
                            url: '{{ route("store.payment") }}',
                            type: 'post',
                            dataType: 'json',
                            data: reqData1,
                            success: function (result){
                                console.log('result ',result);
                                var options = {
                                    "key": "{{env('RAZOR_KEY')}}",
                                    "amount": totalAmount, // 100 paise = INR 1
                                    "name": "WillandMore",
                                    "currency":"INR",
                                    "base_currency": "INR",
                                    "description": "Payment",
                                    "email": "{{@Auth::user()->email}}",
                                    'prefill': {'contact': "{{@Auth::user()->mobile}}", 'email':"{{@Auth::user()->email}}", },
                                    'method': { netbanking: true, card: true, wallet: false, upi: false, paylater: false },
                                    'config': {
                                            'display': {
                                            'hide': [{method: 'paylater'}]
                                            },
                                    },
                                    "image": "https://phpwebdevelopmentservices.com/development/willandmore/willandmore_code/public/images/favicon.png",
                                    "handler": function (response){

                                    console.log('res ',response);
                                    var reqData = {
                                        'jsonrpc' : '2.0',
                                        '_token' : '{{csrf_token()}}',
                                        'params' : {
                                            'razorpay_payment_id'   : response.razorpay_payment_id,
                                            'totalAmount'           : totalAmount,
                                            'package_id'            : id,
                                            'currency'              : "INR",
                                            'currency_id'           : 1,
                                            'page_type'             : "P",
                                            'payment_id'            : result.payment_id,
                                        }
                                    };

                                    $.ajax({
                                            url: '{{ route("payment") }}',
                                            type: 'post',
                                            dataType: 'json',
                                            data: reqData,
                                            success: function (response){
                                                console.log(response);
                                                var willID = response.result.will_id;
                                                window.location.href ="{{url('payment-success')}}/"+willID;
                                                // if(id == 1){
                                                //     window.location.href ="{{url('manage-executor')}}/"+willID;
                                                // }else{
                                                //     window.location.href ="{{url('add-beneficiaries')}}/"+willID;
                                                // }
                                                //window.location.href ="{{url('my-will')}}";
                                            },
                                            error:function(error){
                                                console.log(error);
                                            }
                                        });
                                    },
                                    "theme": {
                                    "color": "#f43930"
                                    }
                                };
                                var rzp1 = new Razorpay(options);
                                rzp1.open();
                                e.preventDefault();
                            },
                            error:function(error){
                                console.log(error);
                            }
                        });
                    }
                    else{
                        return false;
                    }
                });
        });
});
</script>
@endsection
