@extends('layouts.app')
@section('title','')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

    <div class="inner_page_area dashboard_inner">
         <div class="container">
            <div class="row">

               <div class="col-lg-3 col-md-12 col-sm-12">
                    @include('includes.will_sidebar')
               </div>

                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="cus-dashboard-right didlex des-chng">
                        <h2>Introduction</h2>
                        <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    </div>
                    @include('includes.message')

                    <div class="dash-right-inr">

                        <div class="row login_rm02 for_dashboard">

                                <div class="col-lg-12">
                                    <div class="instructions_aar">
                                        <h1>Secure Your Future with Advance Medical Directive Services at WillandMore</h1>
                                        <ul>
                                            <li>An Advance Medical Directive is a legal document that specifies an individual's healthcare preferences and appoints a trusted individual to make medical decisions on their behalf, should they become unable to do so themselves. At WillandMore, we understand the importance of planning for unexpected medical events that may arise in the future. That's why we offer Advance Medical Directive services to help our clients make informed decisions about their healthcare and ensure their wishes are respected in the event they become incapacitated.</li>
                                            <li>Our Advance Medical Directive service allows clients to create a legally binding document that reflects their healthcare preferences and appoints a trusted individual to make medical decisions on their behalf. Our team of experienced estate planning professionals works closely with clients to understand their unique circumstances and healthcare goals, and to provide guidance on the legal and financial implications of their decisions.</li>
                                            <li>We understand that creating an Advance Medical Directive can be an emotional and challenging process, which is why we prioritize clear and effective communication and work to provide our clients with the support and guidance they need throughout the process. In addition to our personalized Advance Medical Directive service, WillandMore also provides clients with a template to create their Advance Medical Directive on their own, if they prefer. This template is easy to use and helps clients create a legally binding document that reflects their healthcare preferences and appoints a trusted individual to make medical decisions on their behalf.</li>
                                            <li>By using our Advance Medical Directive service or our template, clients can have peace of mind knowing that their healthcare preferences will be respected in the event of an unexpected medical event. Contact WillandMore today to learn more about our Advance Medical Directive services and how we can help you secure your future.</li>
                                        </ul>
                                    </div>
                                </div>

                            <div class="col-lg-12 mb-4 mt-4">
                                <div class="pdf_box">
                                    <a href="{{route('user.add.amd',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn" style="width: fit-content;">
                                        Start
                                    </a>
                                </div>
                                <div class="doubleborder"></div>
                            </div>
                        </div>
                    </div>
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
@endsection
