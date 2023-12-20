@extends('admin.layouts.app')
@section('title')
Manage Wills
@endsection
@section('links')
@include('admin.includes.links')
@endsection
@section('headers')
@include('admin.includes.header')
@endsection
@section('sidebar')
@include('admin.includes.sidebar')
@endsection
@section('content')

<div class="content">
    <div class="wraper container-fluid">
        <div class="row">
            <div class="col-sm-12">
            <h4 class="pull-left page-title">Manage Services</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Services</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('manage.will')}}" method="get">
                    {{csrf_field()}}

                      <div class="form-group">
                        <label for="FullName">Keyword</label>
                        <input type="text" @if(@$willuser) value="{{ @$willuser->name }}" @else value="{{@$key['keyword']}}" @endif placeholder="User Name" name="keyword" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label for="">Package</label>
                        <select class="form-control rm06" name="package">
                          <option value="">Select</option>
                          @foreach (@$packages as $item)
                            <option value="{{@$item->id}}" @if(Request::get('package') == @$item->id) selected @endif>{{@$item->package_name}}</option>
                          @endforeach
                        </select>
                      </div>

                      {{-- <div class="form-group">
                        <label for="">Approval Status</label>
                        <select class="form-control rm06" name="approval_status">
                          <option value="">Select</option>
                          <option value="1" {{@$key['approval_status']=='1' ? 'selected' : ''}}>Awaiting Approval</option>
                          <option value="2" {{@$key['approval_status']=='2' ? 'selected' : ''}}>Approved</option>
                          <option value="3" {{@$key['approval_status']=='3' ? 'selected' : ''}}>Changes Suggested</option>
                        </select>
                      </div> --}}

                      <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control rm06" name="status">
                          <option value="">Select</option>
                          <option value="1" {{@$key['status']=='1' ? 'selected' : ''}}>In Progress</option>
                          <option value="2" {{@$key['status']=='2' ? 'selected' : ''}}>Finalized</option>
                          <option value="3" {{@$key['status']=='3' ? 'selected' : ''}}>Completed</option>
                        </select>
                      </div>

                      <div class="rm05" style="margin: 0px 0 0 12px;">
                        <button
                          class="btn btn-primary waves-effect waves-light w-md"
                          type="submit"
                        >
                          Search
                        </button>
                      </div>

                      <div class="rm05" style="margin: 0px 0 0 12px;">
                        <a
                          class="btn btn-primary waves-effect waves-light w-md"
                          href="{{route('manage.will')}}"
                        >
                          Reset
                        </a>
                      </div>
                    </form>
                  </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Package Name</th>
                                                <th>User Name</th>
                                                <th>Start Date</th>
                                                {{-- <th>Approval Status</th> --}}
                                                <th>Status</th>
                                                <th>Completed On</th>
                                                <th class="rm07">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($wills) >0)
                                            @foreach($wills as $will)
                                            <tr>
                                                <td>#{{@$will->id}}</td>
                                                <td width="20%" style="word-break: break-word;">{{@$will->getPackage ? @$will->getPackage->packageDetail->package_name : '-'}}</td>
                                                <td style="word-break: break-word;">{{@$will->userDetails ? $will->userDetails->name : '-' }}</td>
                                                <td>{{@$will->start_date ? date('d.m.Y',strtotime(@$will->start_date)) : '-'}}</td>
                                                {{-- <td>
                                                  @if(@$will->approval_status==1)
                                                      Awaiting Approval
                                                  @elseif(@$will->approval_status==2)
                                                      Approved
                                                  @elseif(@$will->approval_status==3)
                                                      Changes Suggested
                                                  @endif
                                                </td> --}}
                                                <td>
                                                  @if(@$will->status==1)
                                                  In Progress
                                                  @elseif(@$will->status==2)
                                                      Finalized
                                                  @elseif(@$will->status==3)
                                                      Completed
                                                  @endif
                                                </td>
                                                <td>{{@$will->finalized_date ? date('d.m.Y',strtotime(@$will->finalized_date)) : '-'}}</td>

                                                <td class="rm07">
                                                    <a href="javascript:void(0);" class="action-dots actionBtn"
                                                        id="action1"><img src="{{asset('public/admin/assets/images/action-dots.png')}}" alt="" /></a>

                                                    <div class="show-actions show-action" id="show-action1"
                                                        style="display: none">
                                                        <span class="angle"><img src="{{asset('public/admin/assets//images/angle.png')}}" alt="" /></span>

                                                        <ul>

                                                          {{-- <li><a href="{{route('pdf.download',[@$will->id])}}" target="_blank">View</a></li> --}}
                                                          <li><a href="{{route('view.will',[@$will->id])}}">View</a></li>
                                                            {{-- @if(@$will->getPackage->packageDetail->id ==1)
                                                                @if($will->status == 1)
                                                                    <li> <a href="{{route('suggest.will.change',[$will->id])}}">Suggest Change</a> </li>
                                                                @endif
                                                            @endif --}}
                                                            @if($will->status == 1)
                                                                @if($will->approval_status == 1)
                                                                    <li>
                                                                    <a href="{{route('approve.will',[$will->id])}}" onclick="return confirm('Do you want to approve this will ?')">Approved</a>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td>No record found !!</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                {{@$wills->links('pagination_admin')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- content -->
@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')
<script>
$(document).ready(function() {
    $(".actionBtn").click(function() {
        $(".show-action").css('display', 'none');
        $(this).parent().find(".show-action").slideToggle();
        event.stopPropagation();
    });
    // $("#show-action1").click(function (event) {
    //   event.stopPropagation();
    // });
    $("html").click(function() {
        $(".show-action").slideUp();
    });
});
</script>
<script>
      $(function () {
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
      });
    </script>
    <script>
      $('[data-toggle="datepicker"]').datepicker();
    </script>
@endsection
