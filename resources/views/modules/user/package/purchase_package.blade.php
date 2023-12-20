@extends('layouts.app')
@section('title','Purchase Package')
@section('links')
@include('includes.links')
<style>
    .pack_post {
	/* min-height: 595px; */
    height: calc(100% - 30px);
}

</style>
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<div class="inner_page_area dashboard_inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex">
                    @include('includes.message')

                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> {{ $message }}
                        </div>
                    @endif

                    <h2>Purchase Package</h2>
                    <a href="{{route('user.dashboard')}}" class="top_battn_new">Back</a>
                </div>

                <div class="dash-right-inr for_ppcb">

                    <div class="meb_shptxt">
                        {{-- <label><img src="images/m-1.png">My Current Package is : <span>Simple Will</span></label> --}}
                    </div>
                    {{--<form action="{!!route('payment')!!}" method="POST" >
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZOR_KEY') }}"
                                data-amount="1000"
                                data-buttontext="Pay Amount"
                                data-name="WillandMore"
                                data-description="Payment"
                                data-prefill.name="name"
                                data-prefill.email="test@gmail.com"
                                data-prefill.contact="7000892905"
                                data-theme.color="#f43930">
                        </script>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    </form>--}}
                    <div class="posts">

                        <div class="row justify-content-center">
                            @if(@$packages)
                            @foreach(@$packages as $package)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="post pack_post">
                                    <div class="post-thumbnail">
                                        <img src="https://via.placeholder.com/444x344" alt="" class="w-100">
                                    </div>
                                    <div class="post-info">
                                        <h4 class="package_price"><a href="{{route('package.detail',[@$package->id])}}">₹ {{@$package->package_price ? $package->package_price : '0.00'}}</h4>
                                        <h4><a href="{{route('package.detail',[@$package->id])}}">{{@$package->package_name ? $package->package_name : '-'}}</a></h4>
                                        <p>
                                        @if(strlen(@$package->package_desc)>200)
                                                    {{ substr(@$package->package_desc,0,200) . '...' }}
                                                @else
                                                    {{ @$package->package_desc }}
                                                @endif
                                        </p>
                                        <a href="javascript:;" class="purchase_btn purchasePackage" data-amount="{{@$package->package_price ? $package->package_price : '0.00'}}"  data-id="{{@$package->id}}" >Purchase</a>
                                        {{--<a href="{{route('package.detail',[@$package->id])}}" target="_blank" class="btn-default">See more</a>--}}
                                    </div>
                                </div>
                                <!--post end-->
                            </div>
                            @endforeach
                            @endif
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
                                    "email": "{{Auth::user()->email}}",
                                    'prefill': {'contact': "{{Auth::user()->mobile}}", 'email':"{{Auth::user()->email}}", },
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
                                                window.location.href ="{{url('my-will')}}";
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
