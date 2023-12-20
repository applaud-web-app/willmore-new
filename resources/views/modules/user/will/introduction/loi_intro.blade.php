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
                                            <li>A Letter of Instructions is a document setting out the details of liquid and usable assets such as cash, bank accounts, mutual fund units, and the ways to access them in case of incapacitation due to accidents, or debilitating illnesses like Alzheimer’s or Parkinson’s disease. You can update the Letter of Instructions periodically.</li>
                                            <li>The Letter of Instructions written by you can be made available on a specific</li>
                                            <li>Please click here to create your letter of instructions.</li>
                                            <li>Thereafter, you can add a new nominee or choose from persons whom you have added as the beneficiary or executor of your Will, to be the person/s to whom we can send your letter of instructions. We will send them your letter of instructions only on a specific request and after due verification of valid medical documents/certificates submitted by them.</li>
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
