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

            {{-- <div class="col-lg-3 col-md-12 col-sm-12">
                @include('includes.sidebar')
            </div> --}}

            <div class="col-lg-12 col-md-12 col-sm-12">
                
                <div class="cus-dashboard-right didlex">
                    <h2>Consultation</h2>
                </div>
                @include('includes.message')
                <div class="dash-right-inr">



                    <div class="row login_rm02 for_dashboard">
                        <div class="col-md-12 position-relative">
                            <div class="lds-dual-ring"></div>
                            <div id="calendlyDv" style="height:100vh;widht:100%;"></div>
                        </div>
                        
                        <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
                        <script>
                            Calendly.initInlineWidget({
                                "url": '{{config("services.calendly_api.calendly_url")}}',
                                "parentElement": document.getElementById('calendlyDv'),
                                "prefill": {
                                },
                                "utm": {}
                            });
                        </script>

                        <script>
                            function isCalendlyEvent(e) {
                                return e.origin === "https://calendly.com" && e.data.event && e.data.event.indexOf("calendly.") === 0;
                            };
                            
                            window.addEventListener("message", function(e) {
                            if(isCalendlyEvent(e)) {
                                if(e.data.event=='calendly.event_scheduled'){
                                    $(".lds-dual-ring").css('display','flex');
                                    var payload = e.data.payload;
                                    $.post('{{url("store-calendly-event-data")}}',{'_token':'{{csrf_token()}}','uri':payload.event.uri},function(data){
                                        if(data.s==1){
                                            window.location.href = data.url;
                                        }
                                    })
                                }
                                
                            }
                            });
                        </script>

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
