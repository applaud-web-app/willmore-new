@extends('layouts.app')
@section('title','Sitemap')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content') 
<section class="what_banner">
    {{-- <img src="{{asset('public/images/Categories-banner.png')}}"> --}}
</section>

<section class="freelancer-body com_mtop work-chart-sec">
    <div class="container">
        <div class="top-main-profile">
            <div class="contact-wrap">
                <div class="about_us_rowPanel auto-float">
                    <div class="work-chart-box desk-b">
                        <div class="work-chart-top-row">
                            <div class="row">
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="work-chart-iner-row">
                            <div class="row">
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('why_select_dignifiedme')}}">Why-Select-<br>dignifiedme</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('why_now')}}">Why-now</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_dignifiedme_works')}}">How-dignifiedme-Works</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_dignifiedme_works_employer')}}">How-dignifiedme-Works-employer</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_dignifiedme_works_professional')}}">How-dignifiedme-Works-professional</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_is_a_talent_vetted')}}">How-is-a-talentvetted</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_bracketed_pricing_works')}}">How-bracketed-pricingworks</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('what_is_in_a_name')}}">What-is-in-a-name</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('what_do_we_enable')}}">What-do-we-enable</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('what_is_the_future_of_work')}}">What-is-the-future-of-work</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('knowledgebase')}}">Knowledgebaae</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('blog')}}">Blog</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('risk_free_hiring')}}">Risk-free-hiring</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('growth_and_opportunities')}}">Growth-and-opportunitiea</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('flexible_workstyle')}}">Flexible-workatyle</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('self_reliance')}}">Self-reliance</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('dignity_job_faqs')}}">Dignity-job-faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('dignity_score_faqs')}}">Dignity-score-faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('employers.faqs')}}">Employera-faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('professionals.faqs')}}">professional faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('others.faqs')}}">Others faqs</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('about_us')}}">About-us</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('dignifiedme_story')}}">Dignity-Story</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('testimonials')}}">succes-stories</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('careers')}}">Careers</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('contact_us')}}">Contact-us</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('categories')}}">Categories</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('search.project')}}">Search-project</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('search.profissional')}}">Search-professional</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('terms_and_conditions')}}">Terms-and-conditions</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('privacy_policy')}}">Privacy-policy</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('copyright_policy')}}">Copyright-policy</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('code_of_conduct')}}">Code-of-conduct</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('fees_and_charges_employer')}}">Fees-and-charges-employer</a></strong>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                         
                    </div>
                    <div class="work-chart-box mobile-b">
                        
                        <div class="work-chart-iner-row">
                            <div class="row">
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('why_select_dignifiedme')}}">Why-Select-<br>dignifiedme</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('why_now')}}">Why-now</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_dignifiedme_works')}}">How-dignifiedme-Works</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_dignifiedme_works_employer')}}">How-dignifiedme-Works-employer</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_dignifiedme_works_professional')}}">How-dignifiedme-Works-professional</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_is_a_talent_vetted')}}">How-is-a-talentvetted</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('how_bracketed_pricing_works')}}">How-bracketed-pricingworks</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('what_is_in_a_name')}}">What-is-in-a-name</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('what_do_we_enable')}}">What-do-we-enable</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('what_is_the_future_of_work')}}">What-is-the-future-of-work</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('knowledgebase')}}">Knowledgebaae</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('blog')}}">Blog</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('risk_free_hiring')}}">Risk-free-hiring</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('growth_and_opportunities')}}">Growth-and-opportunitiea</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('flexible_workstyle')}}">Flexible-workatyle</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('self_reliance')}}">Self-reliance</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('dignity_job_faqs')}}">Dignity-job-faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('dignity_score_faqs')}}">Dignity-score-faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('employers.faqs')}}">Employera-faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('professionals.faqs')}}">professional faqs</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('others.faqs')}}">Others faqs</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('about_us')}}">About-us</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('dignifiedme_story')}}">Dignity-Story</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('testimonials')}}">succes-stories</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('careers')}}">Careers</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('contact_us')}}">Contact-us</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 new-line">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('categories')}}">Categories</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('search.project')}}">Search-project</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('search.profissional')}}">Search-professional</a></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="work-chart-top-row">
                                        
                                                <div class="work-chart-item">
                                                    <div class="work-chart-itemInner">
                                                        <em></em>
                                                        <strong><a href="{{route('home')}}">Dignifiedme</a></strong>
                                                    </div>
                                                </div>
                                           
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('terms_and_conditions')}}">Terms-and-conditions</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('privacy_policy')}}">Privacy-policy</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('copyright_policy')}}">Copyright-policy</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('code_of_conduct')}}">Code-of-conduct</a></strong>
                                        </div>
                                    </div>
                                    <div class="work-chart-item">
                                        <div class="work-chart-itemInner">
                                            <em></em>
                                            <strong><a href="{{route('fees_and_charges_employer')}}">Fees-and-charges-employer</a></strong>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@guest
<section class="get_stt">
    <div class="container">
        <div class="new_getStarted">
            <span>
                <h5>Connect with your next great hire today!</h5>
                <p>Risk-free hiring made easy</p>
            </span>
            <a class="btns-start professional-btns" href="{{route('login')}}">Get Started <img src="{{asset('public/images/start-arw.png')}}" alt="Get Started"></a>
        </div>
    </div>
</section>
@endguest
@endsection
@section('footer')
@include('includes.footer')
@endsection
@section('script')
@include('includes.scripts')
@endsection