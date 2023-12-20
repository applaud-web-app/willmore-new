@extends('admin.layouts.app')
@section('title')
Manage Success Stories
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
                <h2 class="pageheader-title">Manage Success Stories</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Success Stories </li>
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
                <h5 class="card-header">Manage Success Stories <a class="adbtn btn btn-primary" title="Add new category" href="{{route('create.testimonials')}}"><i class="fa fa-plus" aria-hidden="true"></i> Add Success Stories</a></h5>
                <div class="card-body">
                    <form action="{{route('manage.testimonials.post')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-5 col-12 pad-r">
                                <label for="inputText3" class="col-form-label">keyword </label>
                                <input name="keyword" type="text" class="form-control" placeholder="Type Here" value="{{@$key['keyword']}}">
                            </div>

                            <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-4 col-12 pad-r pad-l">
                                 <label class="col-form-label">Category </label>
                                <select class="form-control category_id" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($category as $val)
                                        <option value="{{$val->id}}" {{@$key['category_id'] == $val->id ? 'selected' :''}}>{{@$val->name}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                              <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-4 col-12 pad-r pad-l">
                                 <label class="col-form-label">Sub Category </label>
                                <select class="form-control subcategory_id" name="subcategory_id">
                                    <option value="">Select</option>
                                    @if(@$key['category_id'])
                                     @foreach($subcategory as $val)
                                        <option value="{{$val->id}}" {{@$key['subcategory_id'] == $val->id ? 'selected' :''}}>{{@$val->name}}</option>
                                    @endforeach  
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-3 col-12 pad-l">
                                <label for="inputPassword" class="col-form-label hide_label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary search_btnUser">Search</button>
                            </div>
                        </div>
                    </form>



                    <div class="table-responsive user_tableBoxMain table-ss wrapper2">
                        <table class="table table-striped table-bordered first ll-pl div2">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    {{-- <th>Problem</th>
                                    <th>Solution</th> --}}
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(@$testimonial)
                                @foreach($testimonial as $val)
                                <tr>
                                    <td>
                                        {{@$val->title}}
                                    </td>
                                    <td>
                                        {{@$val->name}}
                                    </td>
                                    <td>
                                        {{@$val->getCategory->name}}
                                    </td>
                                    <td>
                                        {{@$val->getSubategory->name}}
                                    </td>
                                    {{-- <td class="sorting_1">
                                        {{@$val->problem}}
                                    </td>
                                    <td class="sorting_1">
                                        {{@$val->solution}}
                                    </td> --}}
                                    <td class="sorting_1">
                                        <span class="userposted_imgBox">
                                            @if(@$val->image)
                                                <img src="{{asset('storage/app/testimonials/'.@$val->image)}}" alt="Success Story Image">
                                            @else
                                                <img src="{{asset('public/noimg.png')}}" alt="Success Story Image">
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{route('view.testimonials',[$val->slug])}}"><i class=" fas fa-eye" title="View"></i></a>
                                        <a href="{{route('create.testimonials',[$val->id])}}"><i class=" fas fa-edit" title="Edit"></i></a>
                                        <a href="{{route('delete.testimonials',[$val->id])}}" onclick="return confirm('Do you want to delete this Success Stories ?')"><i class=" fas fa-trash" title="Delete"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
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
<script type="text/javascript">
$(document).ready(function(){
    $('.category_id').change(function(){
    var reqData = {
        'jsonrpc' : '2.0',                
        '_token'  : '{{csrf_token()}}',
        'data'    : {
        'category_id'    : $(this).val()
        }
    };
    $.ajax(
    {
        url: '{{ route('get.sub.category') }}',
        dataType: 'json',
        data: reqData,
        type: 'post',
        success: function(response) 
        {
            console.log(response)
            html='<option value="">Select</option>';
                    response.result.subcategory.forEach(function(item, index){
                        html+='<option value="'+item.id+'">'+item.name+'</option>';
                    });
                    $('.subcategory_id').html(html);
            
        },
        error:function(error) 
        {
            console.log(error.responseText);
        }
    });
    });

});
</script>
@endsection