@extends('layouts.app')
@section('title','Dashboard')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')

<style>
    .lds-dual-ring {
       display: none;
       width: 100%;
       height: 100%;
       position: absolute;
       background: #eaeaea1f;
       justify-content: center;
       align-items: center;
   }
   .lds-dual-ring:after {
     content: " ";
     display: block;
     width: 64px;
     height: 64px;
     margin: 8px;
     border-radius: 50%;
     border: 6px solid #fff;
     border-color: #564949 transparent #564949 transparent;
     animation: lds-dual-ring 1.2s linear infinite;
   }
   @keyframes lds-dual-ring {
     0% {
       transform: rotate(0deg);
     }
     100% {
       transform: rotate(360deg);
     }
   }
   
   </style>
<div class="inner_page_area dashboard_inner">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-12 col-sm-12">
            @include('includes.sidebar')
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="cus-dashboard-right didlex">
                    <h2>Consultations</h2>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">
                    <div class="row login_rm02 for_dashboard">
                        <div class="col-md-12 ">
                            
                            <div class="text-right">

                                @if($consultations->total() > 0 && $payments == 0)
                                    <a href="javascript:void(0);" class="submit_rm w-auto d-inline-block purchase_btn purchasePackage" id="submit" data-amount="590">Add Consultation</a>
                                @else
                                    <a href="{{url("consultation")}}" class="submit_rm w-auto d-inline-block" id="submit">Add Consultation</a>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-md-12 table-responsive position-relative">
                            <div class="lds-dual-ring"></div>
                            <table class="table text-dark">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Event Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Join Url</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @forelse ($consultations as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->event_name}}</td>
                                            <td>{{date("d M Y H:i A",strtotime($item->start_time))}}</td>
                                            <td>{{date("d M Y H:i A",strtotime($item->end_time))}}</td>
                                            <td>{!!$item->join_url!=null ? '<a class="btn btn-primary btn-sm" target="_blank" href="'.$item->join_url.'">View</a>' : '-'!!}</td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @empty
                                        <tr>
                                            <td colspan="5">NO CONSULTATIONS</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
        var pay_amount = $(this).data('amount');
        totalAmount = pay_amount*100;
        totalAmount  = Math.floor(totalAmount*100)/100;
        Swal.fire({
                title: 'Confirm consultation fee Rs. 500 + GST ? ',
                // icon: 'success',
                showCancelButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Pay'
            }).then((result) => {
                if (result.isConfirmed) {
                    var reqData1 = {
                        'jsonrpc' : '2.0',
                        '_token' : '{{csrf_token()}}',
                        'totalAmount'  : totalAmount,
                    };

                    var options = {
                        "key": "{{env('RAZOR_KEY')}}",
                        "amount": totalAmount, // 100 paise = INR 1
                        "name": "WillandMore Consultation Fee",
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
                            var reqData = {
                                'jsonrpc' : '2.0',
                                '_token' : '{{csrf_token()}}',
                                'params' : {
                                    'razorpay_payment_id'   : response.razorpay_payment_id,
                                    'totalAmount'           : totalAmount,
                                    'currency'              : "INR",
                                    'currency_id'           : 1,
                                    'page_type'             : "P",
                                    'payment_id'            : result.payment_id,
                                }
                            };
                            $(".lds-dual-ring").css('display','flex');
                            $.ajax({
                                url: '{{ url("store-consultation-events-payment") }}',
                                type: 'post',
                                dataType: 'json',
                                data: reqData,
                                success: function (response){
                                    window.location.href ="{{url('consultation')}}";
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
                }
                else{
                    return false;
                }
            });
    });
});
</script>
@endsection
