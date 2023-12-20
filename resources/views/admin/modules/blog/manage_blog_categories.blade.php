@extends('admin.layouts.app')
@section('title')
Manage Blog Category
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
                <h4 class="pull-left page-title">Manage Blog Category</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Blog Category</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="btn btn-primary waves-effect waves-light w-md float-right" style="float: right;" href="{{route('create.blog.category')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                        </a>
                    </div>
                    <div class="panel-heading rm02 rm04">
                    <form action="{{route('manage.blog.categories')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="FullName">Keyword</label>

                                <input name="keyword" type="text" class="form-control" placeholder="Type Here" value="{{@$key['keyword']}}">
                            </div>

                            <div class="rm05">
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">
                                    Search
                                </button>
                            </div>

                            <div class="rm05">
                                <a class="btn btn-primary waves-effect waves-light w-md"
                                    href="{{route('manage.blog.categories')}}">
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
                                            <th>Category</th> 
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($bogcatagory) >0)
                                            @foreach(@$bogcatagory as $display) 
                                            <tr>
                                                <td class="sorting_1">
                                                {{@$display->category}}
                                                </td>
                                                <td><a href="{{route('edit.blog.category',$display->id)}}"><i
                                                            class=" fa fa-edit" title="Edit"></i></a>
                                                            <a href="{{route('delete.blog.category',$display->id)}}" onclick="return confirm('Do you want to delete this category ?')"><i class=" fa fa-trash" title="Delete"></i></a>
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

                                {{$bogcatagory->links('pagination_admin')}}
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