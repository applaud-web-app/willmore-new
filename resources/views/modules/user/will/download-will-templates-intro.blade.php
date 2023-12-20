@extends('layouts.app')
@section('title','')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')
<style>
    .will-card-check {
        background-color: #fff;
        margin-bottom: 20px;
        border: 1px solid #F43930;
    }
    .will-card-check .card-body{
        background-color: #F43930;
        padding: 10px;
    }
    .will-card-check .card-footer{
        background-color: #fff;
        padding: 10px;
    }
    @keyframes check {
        0% {
            height: 0;
            width: 0;
        }
        25% {
            height: 0;
            width: 10px;
        }
        50% {
            height: 20px;
            width: 10px;
        }
    }
    .will-card-check .checkbox {
        background-color: #fff;
        display: inline-block;
        height: 20px;
        margin: 0 .25em;
        width: 20px;
        border-radius: 4px;
        border: 1px solid #ccc;
        float: right
    }
    .will-card-check .checkbox span {
        display: block;
        height: 20px;
        position: relative;
        width: 20px;
        padding: 0
    }
    .will-card-check .checkbox span:after {
        -moz-transform: scaleX(-1) rotate(135deg);
    -ms-transform: scaleX(-1) rotate(135deg);
    -webkit-transform: scaleX(-1) rotate(135deg);
    transform: scaleX(-1) rotate(135deg);
    -moz-transform-origin: left top;
    -ms-transform-origin: left top;
    -webkit-transform-origin: left top;
    transform-origin: left top;
    border-right: 4px solid #fff;
    border-top: 4px solid #fff;
    content: '';
    display: block;
    height: 12px;
    left: 3px;
    position: absolute;
    top: 10px;
    width: 8px;
    }
    .will-card-check .checkbox span:hover:after {
        border-color: #999
    }
    .checkbox input {
        display: none
    }
    .will-card-check .checkbox input:checked+span:after {
        -webkit-animation: check .8s;
        -moz-animation: check .8s;
        -o-animation: check .8s;
        animation: check .8s;
        border-color: #F43930
    }
    .will-card-check .check-title{
        font-size: 16px;
        color: #fff
    }
    .will-card-check .check-para{
        font-size: 12px;
        color: #fff
    }
    .will-card-check a{
        color: #000;
    }
</style>
<div class="inner_page_area dashboard_inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <a href="{{url('dashboard')}}" class="back text-dark my-2 d-block"><i class="fas fa-long-arrow-alt-left"></i> Return To Dashboard</a>
                <div class="cusdashb-left">
                    <div class="mobile_menu2"> <i class="fa fa-bars" aria-hidden="true"></i>
                        <span>Show Menu</span>
                    </div>
                    <div class="user_dash_lf_inr" id="mobile_menu_dv2">
                
                        <div class="nav_Pannel">
                            <ul>
                                <li>
                                    <a href="{{url('download-will-templates-intro')}}" class="{{Route::is('download-will-templates-intro') ? 'active' : ''}}"><span><img src="http://localhost/willandmore-v2/public/images/dashboard.png" alt="icon"> </span>
                                        Introduction<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                                </li>
                                <li>
                                    <a href="{{url('download-will-templates')}}" class="{{Route::is('download-will-templates') ? 'active' : ''}}"><span><img src="{{asset('public/images/log-out.png')}}" alt="icon"> </span>
                                        Will Template Download<img class="dash_Arrow" src="{{asset('public/images/dashboard-rightarrow.png')}}"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex des-chng">
                    <h2>Will Template Download</h2>
                  
                </div>
                <div class="dash-right-inr">
                   
                    <div class="text-center">
                      
                        <div class="form-group form-check text-left">
                            <label class="form-check-label text-dark" for="confirm_chck" style="font-size: 16px">Will writing is an important step, without which your financial planning is incomplete. A properly written Will, can distribute your assets as per your wishes, and not the laws of succession. Periodic revisions of the Will ensure that changes in your financial situations, marital status and such other details are reflected in your Will. Through a Will, you can develop a financial plan which benefits the loved ones you leave behind.</label>
                            <p class="mt-4">A few things to remember while writing your Will:</p>
                            <ul class="mt-4" style="color: #000;">
                                <li class="mb-2"> <i class="fas fa-angle-right"></i> A Will can be handwritten or typed; however, a typed Will is preferred to a handwritten one because of better readability.</li>
                                <li class="mb-2"> <i class="fas fa-angle-right"></i> A Will need not be written/typed on a Stamp paper; you can prepare your Will using a good quality white paper of A4 size.</li>
                                <li class="mb-2"> <i class="fas fa-angle-right"></i> A Will can be written or typed in any language.</li>
                                <li class="mb-2"> <i class="fas fa-angle-right"></i> A Will should be written while you are of sound mind.</li>
                                <li class="mb-2"> <i class="fas fa-angle-right"></i> A Will should be duly witnessed by at least 2 persons who should be expected to outlive you.</li>
                                <li class="mb-2"> <i class="fas fa-angle-right"></i> A Will should include your personal details, details of the assets/property, details of the persons to whom you wish to leave your assets/property, name an executor to give effect to your desires as expressed in the Will and details of witnesses.</li>
                            </ul>
                        </div>
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