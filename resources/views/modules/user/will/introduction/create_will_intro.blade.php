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
                                        {{-- <h1><img src="{{asset('public/images/inss.png')}}"> Introduction </h1> --}}
                                        <ul>
                                            <li>Hi there, {{@Auth::user()->name}}! Congratulations on taking the important step of creating your Will.</li>

                                            <li>This is the most crucial document of your life, and the online Will making process is a breeze.
                                                You'll find it intuitive, logical, and completely trouble-free. You've already entered
                                                your personal details when you signed up, and now it's time to fill in the rest of
                                                the details to generate your Will in the form of a pdf document. You can edit
                                                the details and regenerate a modified pdf document during a 30 day period, but after that,
                                                you'll need to purchase a new package to create a new Will because we will purge all details
                                                from our systems</li>

                                            <li>Once you're satisfied with your Will, you'll need to download and print it on a sturdy A4 paper.
                                                Sign the printed Will on all pages and on the designated spot indicated with your name on the last page. </li>

                                            <li>Don't forget to obtain the signatures of your witnesses on the same day. Remember,
                                                the witnesses and you must sign the Will on the same date. </li>

                                            <li>Please keep the printed and signed copy in a safe and accessible place once your Will is executed.
                                                If you wish to, you can register the location of your Will with us using the <a class="txt_href" href="{{route('service_detail',[2])}}">Will Location Registry package.</a>
                                                After you pass away, your beneficiaries, executors, or any other person you nominate can retrieve the location of your
                                                Will by uploading a copy of your death certificate. </li>

                                            <li>We encourage you to take this first step in securing your loved ones’
                                                future by adding the Executor of your Will, Beneficiaries, Witnesses, and details of your assets. </li>

                                            <li>So, go ahead and create your Will today.</li>
                                        </ul>
                                    </div>
                                </div>

                            <div class="col-lg-12 mb-4 mt-4">
                                <div class="pdf_box">
                                        <a href="{{route('user.manage.executor',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn" style="width: fit-content;">
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
