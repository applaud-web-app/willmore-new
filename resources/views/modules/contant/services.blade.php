@extends('layouts.app')
@section('title','Services')
@section('links')
@include('includes.links')
<style>
    .mh-707{
        height: calc(100% - 30px);
    }
    .mh-850{
        float: left;
    display: block;
    margin-bottom: 100px;
    overflow: hidden;
    width: 100%;
    }
</style>
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
                    <li><span>Services</span></li>
                </ul>
                <!--breadcrumb end-->
                <h2 class="page-title">Services</h2>
            </div>
            <!--pager-content end-->
        </div>
        <!--main-banner-content end-->
    </div>
</section>
<!--pager-section end-->

<section class="block">
    <div class="container">
        <div class="section-title services-sec1 sec-big-ttl d-flex flex-wrap align-items-center">
            <h2 class="h-title dark-clr w-100">What can we help you with</h2>
            {{-- <p class="w-100">WillandMore provides you with comprehensive Will creation options to cover different
                aspects of your estate. These include a Will that focuses on passing down a particular
                asset, or a Will that divides your estate between multiple beneficiaries. It could also include
                Will that allows you to make separate provisions for different family members. Besides our
                Letter of Instructions service and Will location Registry will enable you to make sure that
                your wishes are carried out in accordance with your wishes.
            </p> --}}
        </div>
        <!--section-title end-->

        <div class="posts">

            <div class="row">
                @if(@$packages)
                @foreach(@$packages as $package)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post pack_post mh-707">
                        <div class="post-thumbnail">
                            @if(@$package->id == 1)
                            <img src="{{asset('public/images/will_creation.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 2)
                            <img src="{{asset('public/images/will_location.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 3)
                            <img src="{{asset('public/images/will_loi.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 4)
                            <img src="{{asset('public/images/legacy.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 5)
                            <img src="{{asset('public/images/advance_medical.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 6)
                            <img src="{{asset('public/images/consultance.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 8)
                            <img src="{{asset('public/images/consultance.png')}}" alt="" class="w-100">
                            @elseif(@$package->id == 9)
                            <img src="{{asset('public/images/will_location.png')}}" alt="" class="w-100">
                            @endif
                        </div>
                        <div class="post-info">
                            @if(@$package->id != 6 && @$package->id != 9)<h4 class="package_price"><a href="{{route('service_detail',[@$package->id])}}">₹ {{@$package->package_price ? $package->package_price : '0.00'}}
                                <span>@if(@$package->id == 1 || @$package->id == 5) + GST @else for 5 years  + GST @endif</span></h4>@endif
                            <h4><a href="{{route('service_detail',[@$package->id])}}">{{@$package->package_name ? $package->package_name : '-'}}</a></h4>
                            <p>
                            @if(strlen(@$package->package_desc)>200)
                                        {{ substr(@$package->package_desc,0,200) . '...' }}
                                    @else
                                        {{ @$package->package_desc }}
                                    @endif
                            </p>
                            <a href="{{route('service_detail',[@$package->id])}}" title="" class="btn-default mr-4 mt-4">See more</a>

                            @if(@$package->id != 6 && @$package->id != 9)
                                @if(!Auth::check())
                                <a href="javascript:;" class="purchase_btn" data-toggle="modal" data-target="#myModal" >Buy</a>
                                @else
                                <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$package->package_price ? $package->package_price : '0.00'}}"  data-id="{{@$package->id}}" >Buy</a>
                                @endif
                            @else
                                @if(@$package->id != 9)
                                    <a href="{{route('contact_us')}}" class="purchase_btn" >Contact us</a>
                                @endif
                            @endif

                            {{--<a href="{{route('service_detail',[@$package->id])}}" target="_blank" class="btn-default mt-4">See more</a>--}}
                        </div>
                    </div>
                     <!--post end-->
                </div>
                @endforeach
                @endif
                {{--<div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post mh-707">
                        <div class="post-thumbnail">
                            <img src="{{asset('public/images/will_creation.png')}}" alt="" class="w-100">
                        </div>
                        <div class="post-info">
                        <h4 class="package_price"><a href="{{route('service_detail',1)}}">₹ 2499</h4>
                            <h4><a href="{{route('service_detail',1)}}" title="">Online Will Creation</a></h4>
                            <p>Write your Will with our online templates.</p>
                                <p>If you’d like a Custom Will, we’ll help you craft a Will to meet your specific
                                    situation.
                                </p>

                            <a href="{{route('service_detail',1)}}" title="" class="btn-default">See more</a>
                        </div>
                    </div>
                    <!--post end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post mh-707">
                        <div class="post-thumbnail">
                            <img src="{{asset('public/images/will_location.png')}}" alt="" class="w-100">
                        </div>
                        <div class="post-info">
                        <h4 class="package_price"><a href="{{route('service_detail',2)}}">₹ 4999</h4>
                            <h4><a href="{{route('service_detail',2)}}" title="">Will Location Registry</a></h4>
                            <p>Register and store your Will Location securely so your loved ones can find it.</p>
                                <p>We’ll help you find the location of your loved one’s Will through our Search service</p>
                            <a href="{{route('service_detail',2)}}" title="" class="btn-default">See more</a>
                        </div>
                    </div>
                    <!--post end-->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="post mh-707">
                        <div class="post-thumbnail">
                            <img src="{{asset('public/images/will_loi.png')}}" alt="" class="w-100">
                        </div>
                        <div class="post-info">
                        <h4 class="package_price"><a href="{{route('service_detail',3)}}">₹ 3999</h4>
                            <h4><a href="{{route('service_detail',3)}}" title="">Letter of instruction</a></h4>
                            <p>Leave important information for your loved ones, securely and confidentially with us.</p>
                            <a href="{{route('service_detail',3)}}" title="" class="btn-default">See more</a>
                        </div>
                    </div>
                    <!--post end-->
                </div>--}}
            </div>


        </div>
        <!--posts end-->


        <section class="block2">
            <div class="fixed-bg light-bg"></div>
            <div class="container">
                <div class="counter-section">
                    <div class="row row_center">
                        <div class="col-md-3 col-sm-4">
                            <div class="counter-col col-center">
                                <h2><span class="count">250</span></h2>
                                <span>Online Wills created</span>
                            </div>
                            <!--counter-col end-->
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="counter-col col-center">
                                <h2><span class="count">50</span></h2>
                                <span> Letter of Instructions</span>
                            </div>
                            <!--counter-col end-->
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="counter-col col-center">
                                <h2><span class="count">150</span></h2>
                                <span>Will Location Registry service availed</span>
                            </div>
                            <!--counter-col end-->
                        </div>
                        {{-- <div class="col-md-3 col-sm-4">
                            <div class="counter-col">
                                <h2><span class="count">77</span>%</h2>
                                <span>cases won</span>
                            </div>
                            <!--counter-col end-->
                        </div> --}}
                    </div>
                </div>
                <!--counter-section end-->
            </div>
        </section>


        {{-- <div class="counter-section style2">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter-col">
                        <h2><span class="count">21</span>%</h2>
                        <span>charges dropped</span>
                    </div>
                    <!--counter-col end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-col">
                        <h2><span class="count">82</span>%</h2>
                        <span>countersuit filed</span>
                    </div>
                    <!--counter-col end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-col">
                        <h2><span class="count">57</span>%</h2>
                        <span>cases dismissed</span>
                    </div>
                    <!--counter-col end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-col">
                        <h2><span class="count">77</span>%</h2>
                        <span>cases won</span>
                    </div>
                    <!--counter-col end-->
                </div>
            </div>
        </div> --}}
        <!--counter-section end-->

    </div>
</section>
<section class="block">
    <div class="fixed-bg banner_img bg2"></div>
    <div class="container">
        <div class="section-title">
            <h2 class="h-title mw-100">Receive consultation</h2>
            <span>Contact us today for a friendly, no-obligation chat to discuss your Will.</span>
            <span>Complete the form below, and we’ll call you back.</span>
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
{{--<section class="block2 overlay mh-850">
    <div class="fixed-bg bg4"></div>
    <div class="container md">
        <div class="our-proptz">
            <div class="row">
                <div class="col-lg-7">
                    <div class="section-title">
                        <h2 class="h-title mw-100">What are we good at</h2>
                    </div>
                    <div class="proptz">
                        <div class="progres-sec">
                            <h5>Business law</h5>
                            <div class="progress">
                                <div class="progress-bar" data-width="90" role="progressbar" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <span>90%</span>
                            </div>
                        </div>
                        <div class="progres-sec">
                            <h5>Family law</h5>
                            <div class="progress">
                                <div class="progress-bar" data-width="75" role="progressbar" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <span>75%</span>
                            </div>
                        </div>
                        <div class="progres-sec">
                            <h5>Civil litigation</h5>
                            <div class="progress">
                                <div class="progress-bar" data-width="88" role="progressbar" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <span>88%</span>
                            </div>
                        </div>
                        <div class="progres-sec">
                            <h5>Traffic Accidents</h5>
                            <div class="progress">
                                <div class="progress-bar" data-width="97" role="progressbar" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                <span>97%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="img-th">
                        <img src="https://via.placeholder.com/519x645" alt="" class="w-100">
                    </div>
                    <!--img-th end-->
                </div>
            </div>
        </div>
        <!--our-proptz end-->
    </div>
</section>

<section class="block pb-0">
    <div class="container">
        <div class="section-title">
            <h2 class="h-title dark-clr mw-100">Choose your pricing <br /> plan to solve your problem</h2>
        </div>
        <!--section-title end-->
        <div class="price-section">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="price-col">
                        <h3>Basic</h3>
                        <h2>$22.99</h2>
                        <ul>
                            <li>Vestibulum ut mauris ut massa</li>
                            <li>Nunc vel lacinia purus in egeti</li>
                            <li>Aenean diam ante one sapien</li>
                            <li>Donec auctor vehicula risus on</li>
                            <li>Praesent ultricies enim posuere</li>
                        </ul>
                        <a href="{{route('contact_us')}}" title="" class="btn-default">Discuss the problem</a>
                    </div>
                    <!--price-col end-->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="price-col">
                        <h3>Standart</h3>
                        <h2>$55.99</h2>
                        <ul>
                            <li>Vestibulum ut mauris ut massa</li>
                            <li>Nunc vel lacinia purus in egeti</li>
                            <li>Aenean diam ante one sapien</li>
                            <li>Donec auctor vehicula risus on</li>
                            <li>Praesent ultricies enim posuere</li>
                        </ul>
                        <a href="{{route('contact_us')}}" title="" class="btn-default">Discuss the problem</a>
                    </div>
                    <!--price-col end-->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="price-col">
                        <h3>Premium</h3>
                        <h2>$99.99</h2>
                        <ul>
                            <li>Vestibulum ut mauris ut massa</li>
                            <li>Nunc vel lacinia purus in egeti</li>
                            <li>Aenean diam ante one sapien</li>
                            <li>Donec auctor vehicula risus on</li>
                            <li>Praesent ultricies enim posuere</li>
                        </ul>
                        <a href="{{route('contact_us')}}" title="" class="btn-default">Discuss the problem</a>
                    </div>
                    <!--price-col end-->
                </div>
            </div>
        </div>
        <!--price-section end-->
    </div>
</section>


<section class="block2">
    <div class="container">
        <div class="pt-logos text-center">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">IDENTITY</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">MOUNTA</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">GLOBE</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="pt-logo">
                        <img src="https://via.placeholder.com/93x111" alt="">
                        <h4 class="semi-bold text-uppercase">CIRCLE</h4>
                    </div>
                    <!--pt-logos end-->
                </div>
            </div>
        </div>
        <!--pt-logos end-->
    </div>
</section>
--}}

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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
