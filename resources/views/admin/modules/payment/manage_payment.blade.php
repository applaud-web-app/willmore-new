@extends('admin.layouts.app')
@section('title')
Manage Payments
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
            <h4 class="pull-left page-title">Manage Payments</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Payments</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('manage.payment')}}" method="get">
                    

                    <div class="form-group">
                        <label class="form-label">Date From</label>
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
                        <label class="form-label">Date To</label>
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

                      <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control rm06" name="status">
                        <option vlaue="">Select</option>
                                        <option value="1" {{@$key['status'] == 1 ? 'selected' : ''}}>Completed</option>
                                        <option value="2" {{@$key['status'] == 2 ? 'selected' : ''}}>Pending</option>
                                        <option value="3" {{@$key['status'] == 3 ? 'selected' : ''}}>Cancel</option>
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
                          href="{{route('manage.payment')}}"
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
                                            <th>Transaction Id</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Status</th> 
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(@$payments as $val)
                                            <tr>
                                                <td>#{{@$val->id}}</td>
                                                <td>{{@$val->razorpay_payment_id}}</td>
                                                <td>{{ date('d.m.Y', strtotime(@$val->created_at)) }}</td>

                                                <td> 
                                                ₹ {{@$val->price}}
                                                </td>

                                                <td>{{@$val->description ? @$val->description : '-'}}</td>   
                                                <td> @switch(@$val->status)
                                                        @case(1)
                                                        Completed
                                                            @break

                                                        @case(2)
                                                            Pending
                                                            @break

                                                        @case(3)
                                                        Cancel
                                                            @break

                                                        @default
                                                            -
                                                    @endswitch
                                                </td>   
                                                <td class="rm07">
                                                <a href="javascript:void(0);" class="action-dots actionBtn"
                                                        id="action1"><img src="{{asset('public/admin/assets/images/action-dots.png')}}" alt="" /></a>

                                                    <div class="show-actions show-action" id="show-action1"
                                                        style="display: none">
                                                        <span class="angle"><img src="{{asset('public/admin/assets//images/angle.png')}}" alt="" /></span>

                                                        <ul>

                                                          <li><a href="{{route('admin.view.payment',[@$val->id])}}">View</a></li>

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                    </table>
                                </div>

                                {{@$payments->appends(request()->except(['page', '_token']))->links('pagination_admin')}}
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
