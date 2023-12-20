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
                                            <li>Let your loved ones know where your Will is kept and thereby save them the
                                                trouble of searching for your Will after you pass away. </li>

                                            <li> You can register the location of your Will <a class="txt_href" href="{{route('user.add.will.location',[@$will_id])}}"> here.</a> Please remember,
                                                you need to be specific and describe its whereabouts clearly. A few examples would be like: </li>

                                            <li>“in the safe deposit box No. xxx at XYZ bank, branch ….”</li>
                                            <li>“in the bottom left-hand drawer of the desk in the study room of my residence at …..,” or </li>
                                            <li>“in the cardboard box on the top righthand-side of the bedroom cupboard”</li>
                                            <li>“With Mr.XXX, my lawyer who’s office is at ….”</li>
                                            <li>Thereafter, you can add a new nominee or choose from persons whom you have added as
                                                the beneficiary or executor of your Will, to be the person/s to whom we can send the
                                                location of your Will after your death. We will send them the location of your
                                                Will (as per your last location registration) only on a specific request and after due
                                                verification of a valid death certificate submitted by them.</li>
                                        </ul>
                                    </div>
                                </div>

                            <div class="col-lg-12 mb-4 mt-4">
                                <div class="pdf_box">
                                    <a href="{{route('user.add.will.location',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn" style="width: fit-content;">
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
