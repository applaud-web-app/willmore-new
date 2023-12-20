@extends('admin.layouts.app')
@section('title')
Email Template
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
<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Email Template</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Email Template </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @include('admin.includes.message')
            <div class="card">
                <h5 class="card-header">Email Template</h5>
                <div class="card-body">
                    {{-- <div class="Srarch_filterBox">
                        <form action="{{route('manage.payment')}}">
                            <div class="row">
                                <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 pad-r">
                                    <label for="inputText3" class="col-form-label">keyword </label>
                                    <input id="inputText3" type="text" name="keyword" class="form-control" placeholder="Type here" value="{{@$key['keyword']}}">
                                </div>
                                <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12 pad-r pad-l">
                                    <label for="inputText3" class="col-form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option>Select</option>
                                        <option>New</option>
                                        <option>Processed</option>
                                        <option>Cancelled</option>
                                    </select>
                                </div>
                                <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 pad-l">
                                    <label for="inputPassword" class="col-form-label hide_label">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary search_btnUser">Search</a>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                    <div class="table-responsive user_tableBoxMain">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Subject</th>
                                    {{-- <th>Body</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($template as $val)
                                <tr>
                                    <td>{{@$val->template_name}}</td>
                                    <td>{{@$val->email_subject}}</td>
                                    {{-- <td>{{@$val->email_body}}</td> --}}
                                    <td style="text-align: center;">                                           
                                       <a title="Edit"  href="{{route('template.edit',['id'=>@$val->id])}}">
                                            <i class="fa fa-edit" aria-hidden="true"></i> 
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Subject</th>
                                    {{-- <th>Body</th> --}}
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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