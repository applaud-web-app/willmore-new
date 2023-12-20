@extends('layouts.app')
@section('title','Manage Beneficiaries')
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
                    <h2>Manage Beneficiaries</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                        <a href="{{route('user.add.beneficiaries',[@$will_id])}}" class="top_battn_new">Add Beneficiaries</a>
                </div>


                @include('includes.message')
                <div class="dash-right-inr des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table">
                            {{@$currentWill->will_code}}
                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Name</div>
                                <div class="cel_area amunt cess">Aadhar Number</div>
                                <div class="cel_area amunt cess">Mobile Number</div>
                                <div class="cel_area amunt cess">Address</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$beneficiaries) > 0)
                            @foreach(@$beneficiaries as $beneficiar)
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Name</span>
                                    <span class="sm_size">{{@$beneficiar->name}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Aadhar
                                        Number</span> <span class="sm_size">{{@$beneficiar->aadhar_number}} </span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Mobile
                                        Number</span> <span class="sm_size">{{@$beneficiar->phonecode ? '+'.@$beneficiar->getPhonecode->phonecode : ''}} {{@$beneficiar->mobile}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Address</span>
                                    <span class="sm_size">{{@$beneficiar->address1.', '.@$beneficiar->address2.', '.@$beneficiar->zip_code}}</span>
                                </div>

                                {{-- {{@$currentWill->will_code}} --}}
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    {{-- <ul>
                                            <li><a href="{{url('view-beneficiar/'.@$will_id.'/'.@$beneficiar->slug)}}" class="css-tooltip-top color-blue"><span>View</span>
                                                <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                            <li><a href="{{url('update-beneficiaries/'.@$will_id.'/'.@$beneficiar->slug)}}" class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                            <li><a href="javascript:;" class="css-tooltip-top color-blue delete_beneficiar" data-id="{{@$beneficiar->id}}"><span>Delete</span>
                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>
                                    </ul> --}}
                                    <ul>
                                        {{-- @if(@$will_id && @$exe_will_id) --}}

                                        @if(@$locPack->package_id ==1 )
                                        @if(@$will_id != @$beneficiar->will_master_id)
                                             @if(@in_array(@$beneficiar->id, @$existAccessW))
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                    <span>Revoke Beneficiary of Final Will</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                </li>
                                            @else
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                    <span>Make Beneficiary of Final Will</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                </li>
                                            @endif
                                        @endif
                                        @endif


                                        @if(@$locPack->package_id ==2 )
                                             @if(@in_array(@$beneficiar->id, @$existAccessL))
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                    <span>Revoke beneficiary of location Storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                </li>
                                            @else
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                    <span>Make beneficiary of location Storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                </li>
                                            @endif
                                        @endif


                                        @if(@$locPack->package_id ==3 )
                                             @if(@in_array(@$beneficiar->id, @$existAccessLI))
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                    <span>Revoke beneficiary of LOI</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                </li>
                                            @else
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                    <span>Make beneficiary of LOI</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                </li>
                                            @endif
                                        @endif

                                            {{-- @if(@$locPack->package_id ==1 )
                                            @if(@$will_id != @$beneficiar->will_master_id)
                                                @if(@$beneficiar->downAccessW->access_type != 'W')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Beneficiary of Final Will</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$beneficiar->downAccessW->access_type == 'W')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}">
                                                        <span>Revoke Beneficiary of Final Will</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif
                                            @endif


                                            @if(@$locPack->package_id ==2 )
                                                @if(@$beneficiar->downAccessL->access_type != 'L')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                        <span>Make beneficiary of location Storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$beneficiar->downAccessL->access_type == 'L')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}">
                                                        <span>Revoke beneficiary of location Storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif

                                            @endif


                                            @if(@$locPack->package_id ==3 )
                                                @if(@$beneficiar->downAccessLI->access_type != 'LI')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}" data-will="{{@$will_id}}">
                                                        <span>Make beneficiary of LOI</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$beneficiar->downAccessLI->access_type == 'LI')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}">
                                                        <span>Revoke beneficiary of LOI</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif --}}


                                            @if(@$will_id == @$beneficiar->will_master_id)
                                                <li><a href="{{url('view-beneficiar/'.@$beneficiar->will_master_id.'/'.@$beneficiar->slug)}}" class="css-tooltip-top color-blue"><span>View</span>
                                                    <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                                <li><a href="{{url('update-beneficiaries/'.@$beneficiar->will_master_id.'/'.@$beneficiar->slug)}}" class="css-tooltip-top color-blue"><span>Edit</span>
                                                    <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue delete_beneficiar" data-id="{{@$beneficiar->id}}"><span>Delete</span>
                                                    <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>
                                            @endif

                                        {{-- @else
                                            <li><a href="{{url('view-beneficiar/'.@$will_id.'/'.@$beneficiar->slug)}}" class="css-tooltip-top color-blue"><span>View</span>
                                                <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                            <li><a href="{{url('update-beneficiaries/'.@$will_id.'/'.@$beneficiar->slug)}}" class="css-tooltip-top color-blue"><span>Edit</span>
                                                <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                            <li><a href="javascript:;" class="css-tooltip-top color-blue delete_beneficiar" data-id="{{@$beneficiar->id}}"><span>Delete</span>
                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>

                                            @if(@$locPack->package_id ==1 )
                                                @if(@$beneficiar->downAccess->access_type != 'W')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}">
                                                        <span>Make beneficiary of location storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$beneficiar->downAccess->access_type == 'W')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}">
                                                        <span>Revoke beneficiary of location storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif

                                            @if(@$locPack->package_id ==2 )
                                                @if(@$beneficiar->downAccess->access_type != 'L')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}">
                                                        <span>Make beneficiary of location storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$beneficiar->downAccess->access_type == 'L')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}">
                                                        <span>Revoke beneficiary of location storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif
                                            @if(@$locPack->package_id ==3 )
                                                @if(@$beneficiar->downAccess->access_type != 'LI')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_beneficiar" data-name="approve" data-id="{{@$beneficiar->id}}">
                                                        <span>Make beneficiary of LOI</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$beneficiar->downAccess->access_type == 'LI')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_beneficiar" data-name="revoke" data-id="{{@$beneficiar->id}}">
                                                        <span>Revoke beneficiary of LOI</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endif --}}
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess">No Record Found</div>
                            </div>
                            @endif

                        </div>
                    </div>

                    <div class="col-lg-12">
                    {{$beneficiaries->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                        <a href="{{route('user.add.beneficiaries',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                        @if(count(@$beneficiaries) > 0)    
                        Add More Beneficiaries
                        @else 
                        Add Beneficiaries
                        @endif
                    </a>
                    {{-- displaying Generate and Download PDF button --}}
                                @include('includes.download_pdf_btn')
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
  $(document).ready(function(){
    $('.delete_beneficiar').click(function(){
            var id = $(this).data('id');
            Swal.fire({
                    title: 'Delete this beneficiary ? ',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                         window.location.href ="{{url('delete-beneficiar')}}/"+id;
                    }
                    else{
                        return false;
                    }
                });
        });
});
</script>

<script>
    $(document).ready(function(){
      $('.location_beneficiar').click(function(){
              var id = $(this).data('id');
              var name = $(this).data('name');
              var will_id = $(this).data('will');
              Swal.fire({
                      title: 'Do you want to ' +name+ ' this beneficiary as beneficiary of location storage ?',
                      icon: 'warning',
                      showCancelButton: true,
                      cancelButtonText: 'No',
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                      if (result.isConfirmed) {
                           window.location.href ="{{url('approve-location-beneficiar')}}/"+id+"/"+will_id;
                      }
                      else{
                          return false;
                      }
                  });
          });
  });
</script>

<script>
    $(document).ready(function(){
      $('.loi_beneficiar').click(function(){
              var id = $(this).data('id');
              var name = $(this).data('name');
              var will_id = $(this).data('will');
              Swal.fire({
                      title: 'Do you want to ' +name+ ' this as beneficiary of LOI ?',
                      icon: 'warning',
                      showCancelButton: true,
                      cancelButtonText: 'No',
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                      if (result.isConfirmed) {
                           window.location.href ="{{url('approve-loi-beneficiar')}}/"+id+"/"+will_id;
                      }
                      else{
                          return false;
                      }
                  });
          });
  });
</script>

<script>
    $(document).ready(function(){
      $('.will_beneficiar').click(function(){
              var id = $(this).data('id');
              var name = $(this).data('name');
              var will_id = $(this).data('will');
              Swal.fire({
                      title: 'Do you want to ' +name+ ' this as beneficiary of Final Will ?',
                      icon: 'warning',
                      showCancelButton: true,
                      cancelButtonText: 'No',
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                      if (result.isConfirmed) {
                           window.location.href ="{{url('approve-will-beneficiar')}}/"+id+"/"+will_id;
                      }
                      else{
                          return false;
                      }
                  });
          });
  });
</script>

@endsection
