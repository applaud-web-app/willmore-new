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
                <a href="{{route('user.dashboard')}}" class="back text-dark my-2 d-block" style="font-size:18px;"><i class="fas fa-long-arrow-alt-left"></i> Return To Dashboard</a>
                <br/>
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
                    <p>Please select the Will templates that you want to download(you can select more than one)</p>
                    {{-- <a href="{{route('user.mywill')}}" class="top_battn_new">Back</a> --}}
                </div>
                <div class="dash-right-inr">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card will-card-check">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="check-title">Simple Will</h5>
                                            <small class="check-para">English</small>
                                        </div>
                                        <label class="checkbox" for="checkbox1">
                                            <input type="checkbox" name="will_check[]" id="checkbox1" value="simple_will_english"/>
                                            <span class="primary"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">View more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card will-card-check">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="check-title">Simple Will</h5>
                                            <small class="check-para">Hindi</small>
                                        </div>
                                        <label class="checkbox" for="checkbox2">
                                            <input type="checkbox" name="will_check[]" id="checkbox2" value="simple_will_hindi"/>
                                            <span class="primary"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">View more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card will-card-check">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="check-title">Individual Will</h5>
                                            <small class="check-para">Expanded</small>
                                        </div>
                                        <label class="checkbox" for="checkbox3">
                                            <input type="checkbox" name="will_check[]" id="checkbox3" value="individual_will"/>
                                            <span class="primary"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">View more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card will-card-check">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="check-title">Mirror Will</h5>
                                            
                                        </div>
                                        <label class="checkbox" for="checkbox4">
                                            <input type="checkbox" name="will_check[]" id="checkbox4" value="mirror_will"/>
                                            <span class="primary"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">View more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card will-card-check">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="check-title">Joint Will</h5>
                                        </div>
                                        <label class="checkbox" for="checkbox5">
                                            <input type="checkbox" name="will_check[]" id="checkbox5" value="joint_will"/>
                                            <span class="primary"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">View more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card will-card-check">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="check-title">Codicil</h5>
                                        </div>
                                        <label class="checkbox" for="checkbox6">
                                            <input type="checkbox" name="will_check[]" id="checkbox6" value="codicil"/>
                                            <span class="primary"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="">View more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="text-dark mb-3">A COPY OF THE TEMPLATES WILL BE SENT TO YOUR MAIL</h5>
                        <div class="form-group form-check text-left">
                            <input type="checkbox" class="form-check-input" id="confirm_chck" value="1">
                            <label class="form-check-label text-dark" for="confirm_chck" style="font-size: 12px">We are responsible only for the contents of the template, and not for the Wills prepared by the clients based on the template document. The download of the template does not entail legal advice, but provided a standardized format for Will creation that a client may use as a guidance only. I have read the Privacy policy, Disclaimer, Terms & Conditions and acknowledge and accept the same</label>
                          </div>
                          <div class="atz-btn view-atz text-center" style="margin-top: 10px">
                            <a href="javascript:void(0);"  class="mx-auto" id="download_will_btn"> Download </a>
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
<script>
    $("#download_will_btn").on('click',function(){
        var chck = document.getElementById('confirm_chck');
        if(chck.checked){
            var chckArr = [];
            var len = $('input[name="will_check[]"]:checked').length;
            if(len){
                
                $('input[name="will_check[]"]:checked').each(function(e){
                    chckArr.push($(this).val());
                })
                window.location.href = '{{url("process-will-template-download")}}?files_str='+chckArr;
            }
           
        }else{
            alert('Please confirm your download');
        }
    })
</script>
@endsection