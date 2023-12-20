@extends('layouts.app')
@section('title','Manage Executor')
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
                    <h2>Manage Executor</h2>
                    <p>You can go back to any of your previous options by clicking on the links on the left side</p>
                    @if(@$will_id && @$exe_will_id)
                        {{--  --}}
                    @else
                        @if(@$countExecutor < 1)
                        <a href="{{route('user.add.executor',[@$will_id])}}" class="top_battn_new">Add Executor</a>
                        @endif
                    @endif
                </div>


                @include('includes.message')
                <div class="dash-right-inr tbl-over des-ch-btn">

                    <div class="col-lg-12 mb-4 mt-1 tabble_ress">
                        <div class="table_01 table tbl-over">
                            {{@$currentWill->will_code}}
                            <div class="row amnt-tble">
                                <div class="cel_area amunt cess">Name</div>
                                <div class="cel_area amunt cess">Aadhar Number</div>
                                <div class="cel_area amunt cess">Mobile Number</div>
                                <div class="cel_area amunt cess">Address</div>
                                <div class="cel_area amunt cess">Action</div>
                            </div>

                            <!--table row-1-->
                            @if(count(@$executors) > 0)
                            @foreach(@$executors as $executor)
                            <div class="row small_screen2 for_bg_color_01">
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Name</span>
                                    <span class="sm_size">{{@$executor->name}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Aadhar
                                        Number</span> <span class="sm_size">{{@$executor->aadhar_number}} </span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Mobile
                                        Number</span> <span class="sm_size">{{@$executor->phonecode ? '+'.@$executor->getPhonecode->phonecode : ''}} {{@$executor->mobile}}</span></div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Address</span>
                                    <span class="sm_size">{{@$executor->address1.', '.@$executor->address2.', '.@$executor->zip_code}}</span>
                                </div>
                                <div class="cel_area amunt-detail cess"> <span class="hide_big">Action</span>
                                    <ul>
                                        {{-- @if(@$will_id && @$exe_will_id) --}}

                                            {{-- @if(@$locPack->package_id ==1 )
                                            @if(@$will_id != @$executor->will_master_id)
                                                @if(@$executor->downAccessW->access_type != 'W')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_executor" data-name="approve" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Executor of Final Will</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$executor->downAccessW->access_type == 'W')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_executor" data-name="revoke" data-id="{{@$executor->id}}">
                                                        <span>Revoke Executor of Final Will</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif
                                            @endif --}}

                                            @if(@$locPack->package_id ==1 )
                                            @if(@$will_id != @$executor->will_master_id)
                                                @if(@in_array(@$executor->id, @$existAccessW))
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_executor" data-name="revoke" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Revoke Executor of Final Will</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @else
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc will_executor" data-name="approve" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Executor of Final Will</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif
                                            @endif

                                            {{-- @if(@in_array(@$executor->id, @$existAccess)) $existAccess = WillDownloadAccess::where('exe_id',$id)->where('will_id',@$will_id)->where('access_type','L')->first(); --}}

                                            @if(@$locPack->package_id ==2 )
                                                @if(@in_array(@$executor->id, @$existAccessL))
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_executor" data-name="revoke" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Revoke Executor of location Storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @else
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_executor" data-name="approve" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Executor of location Storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif

                                            {{-- @if(@$locPack->package_id ==2 )
                                                @if(@$executor->downAccessL->exe_id != @$executor->id)
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_executor" data-name="approve" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Executor of location Storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                                @if(@$executor->downAccessL->access_type == 'L')
                                                    @if(@$executor->downAccessL->will_id == @$will_id)
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_executor" data-name="revoke" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Revoke Executor of location Storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                    @endif
                                                @endif
                                            @endif --}}

                                            @if(@$locPack->package_id ==3 )
                                                @if(@in_array(@$executor->id, @$existAccessLI))
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_executor" data-name="revoke" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Revoke Executor of LOI</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @else
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_executor" data-name="approve" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Executor of LOI</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif

                                            {{-- @if(@$locPack->package_id ==3 )
                                                @if(@$executor->downAccessLI->access_type != 'LI')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_executor" data-name="approve" data-id="{{@$executor->id}}" data-will="{{@$will_id}}">
                                                        <span>Make Executor of LOI</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$executor->downAccessLI->access_type == 'LI')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_executor" data-name="revoke" data-id="{{@$executor->id}}">
                                                        <span>Revoke Executor of LOI</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif --}}

                                            @if(@$will_id == @$executor->will_master_id)
                                                <li><a href="{{url('view-executor/'.@$will_id.'/'.@$executor->slug)}}" class="css-tooltip-top color-blue"><span>View</span>
                                                    <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                                <li><a href="{{url('update-executor/'.@$will_id.'/'.@$executor->slug)}}" class="css-tooltip-top color-blue"><span>Edit</span>
                                                        <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                                <li><a href="javascript:;" class="css-tooltip-top color-blue delete_executor" data-id="{{@$executor->id}}"><span>Delete</span>
                                                    <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>
                                            @endif

                                        {{-- @else
                                            <li><a href="{{url('view-executor/'.@$will_id.'/'.@$executor->slug)}}" class="css-tooltip-top color-blue"><span>View</span>
                                                <img src="{{asset('public/images/view.png')}}" alt=""></a></li>
                                            <li><a href="{{url('update-executor/'.@$will_id.'/'.@$executor->slug)}}" class="css-tooltip-top color-blue"><span>Edit</span>
                                                    <img src="{{asset('public/images/edit.png')}}" alt=""></a></li>
                                            <li><a href="javascript:;" class="css-tooltip-top color-blue delete_executor" data-id="{{@$executor->id}}"><span>Delete</span>
                                                <img src="{{asset('public/images/remove1.png')}}" alt=""></a></li>

                                            @if(@$locPack->package_id ==2 )
                                                @if(@$executor->location_storage_access == 'N')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_executor" data-name="approve" data-id="{{@$executor->id}}">
                                                        <span>Make Executor of location Storage</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$executor->location_storage_access == 'Y')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc location_executor" data-name="revoke" data-id="{{@$executor->id}}">
                                                        <span>Revoke Executor of location Storage</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
                                                    </li>
                                                @endif
                                            @endif
                                            @if(@$locPack->package_id ==3 )
                                                @if(@$executor->loi_access == 'N')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_executor" data-name="approve" data-id="{{@$executor->id}}">
                                                        <span>Make Executor of LOI</span><img src="{{asset('public/images/icon5.png')}}" alt=""></a>
                                                    </li>
                                                @elseif(@$executor->loi_access == 'Y')
                                                    <li><a href="javascript:;" class="css-tooltip-top color-blue tooltip-spc loi_executor" data-name="revoke" data-id="{{@$executor->id}}">
                                                        <span>Revoke Executor of LOI</span><img src="{{asset('public/images/tab_icon02.png')}}" alt=""></a>
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
                    {{$executors->links('pagination')}}
                    </div>

                    <div class="pdf_box">
                        @if(@$countExecutor < 1)
                            <a href="{{route('user.add.executor',[@$will_id])}}" class="submit_rm bntt_collor pdf_btn">
                            {{-- @if(count(@$executors) > 0)
                            Add More Executor
                            @else
                            Add Executor
                            @endif --}}
                            Add Executor
                            </a>
                        @endif
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
    $('.delete_executor').click(function(){
            var id = $(this).data('id');
            Swal.fire({
                    title: 'Delete this executor ? ',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                         window.location.href ="{{url('delete-executor')}}/"+id;
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
      $('.location_executor').click(function(){
              var id = $(this).data('id');
              var name = $(this).data('name');
              var will_id = $(this).data('will');
              Swal.fire({
                      title: 'Do you want to ' +name+ ' this executor as executor of location storage ?',
                      icon: 'warning',
                      showCancelButton: true,
                      cancelButtonText: 'No',
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                      if (result.isConfirmed) {
                           window.location.href ="{{url('approve-location-executor')}}/"+id+"/"+will_id;
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
      $('.loi_executor').click(function(){
              var id = $(this).data('id');
              var name = $(this).data('name');
              var will_id = $(this).data('will');
              Swal.fire({
                      title: 'Do you want to ' +name+ ' this as executor of LOI ?',
                      icon: 'warning',
                      showCancelButton: true,
                      cancelButtonText: 'No',
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                      if (result.isConfirmed) {
                           window.location.href ="{{url('approve-loi-executor')}}/"+id+"/"+will_id;
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
      $('.will_executor').click(function(){
              var id = $(this).data('id');
              var name = $(this).data('name');
              var will_id = $(this).data('will');
              Swal.fire({
                      title: 'Do you want to ' +name+ ' this as executor of Final Will ?',
                      icon: 'warning',
                      showCancelButton: true,
                      cancelButtonText: 'No',
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                      if (result.isConfirmed) {
                           window.location.href ="{{url('approve-will-executor')}}/"+id+"/"+will_id;
                      }
                      else{
                          return false;
                      }
                  });
          });
  });
</script>

@endsection
