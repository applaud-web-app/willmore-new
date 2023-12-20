@extends('layouts.app')
@section('title','WillAndMore')
@section('links')
@include('includes.links')
@endsection
@section('headers')
@include('includes.header')
@endsection
@section('content')


<section class="pager-section login_bg overlay banner_small_rm">
    <div class="container">
        <div class="main-banner-content p-relative">
            <div class="social-links">
                <ul>
                    <li><a href="#" title=""><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div><!--social-links end-->
            <div class="pager-content">

                <h2 class="page-title">Nominee Executor</h2>
                <ul class="breadcrumb-list">
                    <li><a href="{{route('home')}}" title="">Home</a></li>
                    {{-- <li><span>Login</span></li> --}}
                </ul><!--breadcrumb end-->
            </div><!--pager-content end-->
        </div><!--main-banner-content end-->
    </div>
</section><!--pager-section end-->



    <div class="inner_page_area dashboard_inner">
         <div class="container">
            <div class="row">




               <div class="col-lg-12 col-md-12 col-sm-12">
                  {{-- <div class="cus-dashboard-right didlex"><h2>Nominee Executor</h2></div> --}}

                  <div class="dash-right-inr">


                  <div class="col-lg-12 mb-4 mt-2">
                  <div class="ne_excc">
                      <p><strong><img src="images/dp01.png" alt=""> Name of Person</strong> <span>: {{ @$will->userDetails->name}}</span></p>
                      {{-- <p><strong><img src="images/dp02.png" alt=""> Will Created On</strong> <span>: {{ @$will->start_date? date('d.m.Y',strtotime(@$will->start_date)) : '-'}}</span></p> --}}
                      @if(@$will->will_location !=null)
                      <p><strong><img src="images/dp03.png" alt=""> Location of physical copy of will</strong> <span>: {{ @$will->will_location}} </span></p>
                      <p><strong><img src="images/dp03.png" alt=""> Address of physical copy of will</strong> <span>: {{ @$will->address}} </span></p>
                      @endif
                      {{-- @if(@$will->loi !=null)
                      <p><strong><img src="images/dp03.png" alt=""> letter of instruction</strong> <span>: {{ @$will->loi}} </span></p>
                      @endif --}}
                      {{-- @if(@$will->amd_text !=null)
                      <p><strong><img src="images/dp03.png" alt=""> Advance Medical Directive</strong> <span>: {{ @$will->amd_text}} </span></p>
                      @endif --}}
                      <!--<p><strong><img src="images/dp03.png" alt=""> Address</strong> <span>: This is a simply dummy address text</span></p>-->
                  </div>
                  </div>





                 		<div class="col-lg-12 mb-4 mt-4">
                            <div class="doubleborder"></div>
                            <div class="doubleborder"></div>
                        </div>

                        <form>
                        <div class="row login_rm02 for_dashboard">

        @if(@$will->final_will_file !=null)
		<div class="col-lg-4 col-md-6">
           <div class="uplodimg gigupld">
               <span>Download the softcopy of the will</span>
               <div class="uplodimgfil">
                   {{-- <input class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                   <label for="file-1">Click here to download <img src="images/clickhe02.png" alt=""></label> --}}
                   <a href="{{url('storage/app/public/final_will_file')}}\{{@$will->final_will_file}}" target="_blank" class="submit_rm bntt_collor des-ch-btn pdf_alrt2">Click here to download</a>
               </div>
           </div>
        </div>
        @endif
        @if(@$will->loi_file !=null)
		<div class="col-lg-4 col-md-6">
           <div class="uplodimg gigupld">
               <span>Download the letter of instruction File</span>
               <div class="uplodimgfil">
                   {{-- <input class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                   <label for="file-1">Click here to download <img src="images/clickhe02.png" alt=""></label> --}}
                   <a href="{{url('storage/app/public/loi_file')}}\{{@$will->loi_file}}" target="_blank" class="submit_rm bntt_collor des-ch-btn pdf_alrt2">Click here to download</a>
               </div>
           </div>
        </div>
        @endif

        @if(@$will->amd_file !=null)
		<div class="col-lg-4 col-md-6">
           <div class="uplodimg gigupld">
               <span>Download the AMD File</span>
               <div class="uplodimgfil">
                   {{-- <input class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                   <label for="file-1">Click here to download <img src="images/clickhe02.png" alt=""></label> --}}
                   <a href="{{url('storage/app/public/amd_file')}}\{{@$will->amd_file}}" target="_blank" class="submit_rm bntt_collor des-ch-btn pdf_alrt2">Click here to download</a>
               </div>
           </div>
        </div>
        @endif

                       <!-- <div class="col-lg-12 mb-4 mt-4">
                            <div class="doubleborder"></div>
                            <div class="doubleborder"></div>
                        </div>

                        <div class="col-lg-12">
                            <button type="button" class="submit_rm" id="submit">Save all changes</button>
                        </div>-->
                </form>

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
