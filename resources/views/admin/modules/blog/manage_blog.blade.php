@extends('admin.layouts.app')
@section('title')
Manage Blogs
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
                <h4 class="pull-left page-title">Manage Blogs</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Manage Blogs</li>
                </ol>
            </div>
        </div>

        @include('admin.includes.message')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="btn btn-primary waves-effect waves-light w-md float-right" style="float: right;" href="{{route('create.blog')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add
                        </a>
                    </div>
                    <div class="panel-heading rm02 rm04">
                        <form role="form" action="{{route('manage.blog')}}" method="get">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="FullName">Keyword</label>

                                <input name="keyword" type="text" class="form-control" placeholder="Type Here"
                                    value="{{@$key['keyword']}}">
                            </div>

                            <div class="form-group">
                                <label for="">Category</label>

                                <select class="form-control" name="category_id">
                                    <option value="">Select</option>

                                    @foreach($blogcatdata as $val)
                                    <option value="{{$val->id}}" {{@$key['category_id']==@$val->id ? 'selected' : ''}}>
                                        {{@$val->category}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="rm05">
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">
                                    Search
                                </button>
                            </div>

                            <div class="rm05">
                                <a class="btn btn-primary waves-effect waves-light w-md"
                                    href="{{route('manage.blog')}}">
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
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Image</th>
                                                <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if(count($blogdata) >0)
                                            @foreach(@$blogdata as $displayblog)
                                            <tr>
                                                <td class="sorting_1">
                                                    {{@$displayblog->getBlogCata->category}}
                                                </td>
                                                <td width="20%" style="word-break: break-word;">
                                                    {{@$displayblog->title}}</td>

                                                <td style="word-break: break-word;">{{@$displayblog->author_name}}</td>
                                                <td><span class="userposted_imgBox">
                                                        @if(@$displayblog->image)
                                                        <img src="{{asset('storage/app/blog_cata_img/'.@$displayblog->image)}}"
                                                            alt="Blog Image" width="30">
                                                        @else
                                                        <img src="{{asset('public/images/blank.png')}}">
                                                        @endif
                                                    </span></td>
                                                <td><a href="{{route('edit.blog',$displayblog->id)}}"><i
                                                            class=" fa fa-edit" title="Edit"></i></a>
                                                    <a href="{{route('delete.blog',$displayblog->id)}}"
                                                        onclick="return confirm('Do you want to delete this blog ?')"><i
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

                                {{$blogdata->links('pagination_admin')}}
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
