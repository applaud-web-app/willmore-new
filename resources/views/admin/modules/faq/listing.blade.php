@extends('admin.layouts.app')
@section('title')
Manage FAQ
@endsection
@section('links')
@include('admin.includes.links')
<style>
.save_all_changes_btn {
    height: 40px;
    padding: 0px 18px;
    background: #ff6400;
    color: #fff;
    border-radius: 2px;
    font-family: 'Roboto', sans-serif;
    cursor: pointer;
    font-size: 14px;
    border: none;
    font-weight: 500;
    display: inline-block;
    line-height: 40px;
    /* margin-top: 5px; */
    text-transform: uppercase;
}

a.save_all_changes_btn:hover {
    background: #4e128a;
    color: #fff;
}
</style>
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
                <h4 class="pull-left page-title">Manage FAQ</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage FAQ</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="btn btn-primary waves-effect waves-light w-md float-right" style="float: right;"
                            href="{{route('create.faq')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add FAQ
                        </a>
                    </div>
                    <div class="panel-heading rm02 rm04">
                        <form action="{{route('manage.faq.post')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="FullName">Keyword</label>

                                <input name="keyword" type="text" class="form-control" placeholder="Type Here"
                                    value="{{@$key['keyword']}}">
                            </div>

                            <div class="rm05">
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">
                                    Search
                                </button>
                            </div>

                            <div class="rm05">
                                <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.faq')}}">
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
                                                <th></th>
                                                <th>Question</th>
                                                <th>Answer</th>
                                                {{-- <th>For</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($faq) >0)
                                            @foreach($faq as $key => $val)
                                            <tr>
                                                <td class="sorting_1" width="2%">
                                                    {{@$key+1}}
                                                </td>
                                                <td style="word-break: break-word;">
                                                    {{@$val->question}}</td>
                                                <td style="word-break: break-word;">
                                                    {!! @$val->answer !!}</td>

                                                {{-- <td style="word-break: break-word;">@if(@$val->type=='SS')
                                                    Employers
                                                    @elseif(@$val->type=='SP')
                                                    Freelancers
                                                    @elseif(@$val->type=='OT')
                                                    Others
                                                    @endif</td> --}}

                                                <td><a href="{{route('create.faq',[$val->id])}}"><i class=" fa fa-edit"
                                                            title="Edit"></i></a>
                                                    <a href="{{route('delete.faq',[$val->id])}}"
                                                        onclick="return confirm('Do you want to delete this FAQ ?')"><i
                                                            class=" fa fa-trash" title="Delete"></i></a>
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

                                {{$faq->links('pagination_admin')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')

@endsection
