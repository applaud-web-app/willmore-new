@extends('admin.layouts.app')
@section('title')
Manage Users
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
            <h4 class="pull-left page-title">Manage Users</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Users</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('manage.user')}}" method="get">
                    {{csrf_field()}}
                      <div class="form-group">
                        <label for="FullName">Keyword</label>

                        <input
                          type="text"
                          value="{{@$key['keyword']}}"
                          placeholder="Enter here"
                          name="keyword"
                          class="form-control"
                        />
                      </div>

                      <div class="form-group">
                        <label for="">Status</label>

                        <select class="form-control rm06" name="status">
                                    <option value="">Select</option>
                                    <option value="A" {{@$key['status']=='A' ? 'selected' : ''}}>Active</option>
                                    <option value="I" {{@$key['status']=='I' ? 'selected' : ''}}>Inactive</option>
                                    <option value="U" {{@$key['status']=='U' ? 'selected' : ''}}>Unverified</option>
                                </select>
                      </div>

                      <div class="form-group">
                        <label class="form-label">Joining Date From</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter here"
                          id="datepicker"
                          name="from_date"
                          value="{{@$key['from_date']}}"
                        />
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                      </div>

                      <div class="form-group">
                        <label class="form-label">Joining Date To</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter here"
                          id="datepicker2"
                          name="to_date"
                          value="{{@$key['to_date']}}"
                        />
                        <i class="fa fa-calendar" aria-hidden="true"></i>
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
                          href="{{route('manage.user')}}"
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
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>DOB</th>
                                                <th>Country</th>
                                                <th>Registered on</th>
                                                <th>Status</th>
                                                <th class="rm07">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($users) >0)
                                            @foreach($users as $val)
                                            <tr>
                                                <td class="sorting_1">
                                                @if(@$val->image)
                                                    <img src="{{asset('storage/app/public/userImage/'.@$val->image)}}" class="ad-ban" height="35">
                                                @else
                                                    <img src="{{asset('public/images/avatar.png')}}" class="ad-ban" height="35">
                                                @endif
                                                </td>
                                                <td width="20%" style="word-break: break-word;">{{@$val->name ? @$val->name : "-"}}</td>
                                                <td>{{@$val->username ? @$val->username : "-"}}</td>
                                                <td style="word-break: break-word;">{{@$val->email ? @$val->email : "-"}}</td>
                                                <td>{{date("d.M.Y",strtotime($val->dob))}}</td>
                                                <td>{{@$val->country  ? @$val->getCountry->name  : "-"}}</td>
                                                <td>{{date("d.M.Y",strtotime($val->created_at))}}</td>
                                                <td>
                                                @if(@$val->status=='A')
                                                    Active
                                                @elseif(@$val->status=='I')
                                                    Inactive
                                                @else
                                                    Unverified
                                                @endif
                                                </td>

                                                <td class="rm07">
                                                    <a href="javascript:void(0);" class="action-dots actionBtn"
                                                        id="action1"><img src="{{asset('public/admin/assets/images/action-dots.png')}}" alt="" /></a>

                                                    <div class="show-actions show-action" id="show-action1"
                                                        style="display: none">
                                                        <span class="angle"><img src="{{asset('public/admin/assets//images/angle.png')}}" alt="" /></span>

                                                        <ul>
                                                            <li><a href="{{route('view.user',[$val->id])}}">View</a></li>

                                                            <li><a href="{{route('delete.user',[$val->id])}}" onclick="return confirm('Do you want to delete this user ?')">Delete</a>
                                                            </li>

                                                            @if($val->status == 'A')
                                                            <li><a href="{{route('change.User.status',[$val->id])}}" onclick="return confirm('Do you want to change status for this user ?')">Inactivate</a>
                                                            </li>
                                                            @elseif($val->status == 'I')
                                                            <li><a href="{{route('change.User.status',[$val->id])}}" onclick="return confirm('Do you want to change status for this user ?')">Activate</a>
                                                            </li>
                                                            @endif
                                                            <li><a href="{{route('manage.will',[$val->id])}}">View Services</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="3">No record</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                {{$users->links('pagination_admin')}}
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
