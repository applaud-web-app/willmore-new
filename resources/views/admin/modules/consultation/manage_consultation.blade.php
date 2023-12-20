@extends('admin.layouts.app')
@section('title')
Manage Consultation & Contact Request
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
            <h4 class="pull-left page-title">Manage Consultation & Contact Request</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Consultation & Contact Request</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading rm02 rm04">
                    <form role="form" action="{{route('manage.consultation')}}" method="get">
                        {{csrf_field()}}

                        {{-- <div class="form-group">
                            <label for="FullName">Keyword</label>
                            <input type="text" @if(@$willuser) value="{{ @$willuser->name }}" @else value="{{@$key['keyword']}}" @endif placeholder="User Name" name="keyword" class="form-control" />
                        </div> --}}

                        <div class="form-group">
                            <label for="">Type</label>
                            <select class="form-control rm06" name="type">
                                <option value="">Select</option>
                                <option value="C" {{@$key['type']=='C' ? 'selected' : ''}}>Consultation</option>
                                <option value="CU" {{@$key['type']=='CU' ? 'selected' : ''}}>Contact Us</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Send Date</label>
                            <input type="text" class="form-control" placeholder="Enter here" id="datepicker" name="send_date" value="{{@$key['send_date']}}"/>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>

                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit"> Search </button>
                        </div>
                        <div class="rm05" style="margin: 0px 0 0 12px;">
                            <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.consultation')}}"> Reset </a>
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
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Type</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <th>Send Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($consultation) >0)
                                            @foreach($consultation as $key => $consul)
                                            <tr>
                                                <td>{{@$key+1}}</td>
                                                <td width="20%" style="word-break: break-word;">{{@$consul->name}}</td>
                                                <td>{{@$consul->phonecode ? '+'.@$consul->phonecode : ''}} {{@$consul->phone}}</td>
                                                <td>
                                                    @if(@$consul->form_type == 'C')
                                                        Consultation
                                                    @elseif(@$consul->form_type == 'CU')
                                                        Contact Us
                                                    @endif
                                                </td>
                                                <td>{{@$consul->email}}</td>
                                                <td style="word-break: break-word;">
                                                    {{-- @if(strlen(@$consul->message)>55)
                                                        {!! str_limit(strip_tags(@$consul->message), 55) !!}
                                                    @else
                                                        {!! @$consul->message !!}
                                                    @endif --}}
                                                    {{ @$consul->message }}
                                                </td>
                                                <td>{{@$consul->created_at ? date('d.m.Y',strtotime(@$consul->created_at)) : '-'}}</td>
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

                                {{@$consultation->links('pagination_admin')}}
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
