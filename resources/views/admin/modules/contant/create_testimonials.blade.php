@extends('admin.layouts.app')
@section('title')
@if(@$testimonials) Edit @else Add @endif Success Stories
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
                <h2 class="pageheader-title">@if(@$testimonials) Edit @else Add @endif Success Stories</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manage.testimonials')}}" class="breadcrumb-link">Manage Success Stories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@if(@$testimonials) Edit @else Add @endif Success Stories</li>
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
                <h5 class="card-header">@if(@$testimonials) Edit @else Add @endif Success Stories<a class="adbtn btn btn-primary" href="{{route('manage.testimonials')}}"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a></h5>
                <div class="card-body">
                    <form id="faqform" method="post" action="{{ route('store.testimonials') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{@$testimonials->id}}" name="id" >
                        <div class="row">
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pad-r">
                                <label class="col-form-label">Category </label>
                                <select class="form-control category_id" name="category_id">
                                    <option value="">Select</option>
                                    @foreach($category as $val)
                                        <option value="{{$val->id}}" {{@$testimonials->category_id == $val->id ? 'selected' :''}}>{{@$val->name}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pad-r">
                                <label class="col-form-label">Sub Category </label>
                                <select class="form-control subcategory_id" name="subcategory_id">
                                    <option value="">Select</option>
                                    @if(@$testimonials->subcategory_id)
                                     @foreach($subcategory as $val)
                                        <option value="{{$val->id}}" {{@$testimonials->subcategory_id == $val->id ? 'selected' :''}}>{{@$val->name}}</option>
                                    @endforeach  
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pad-r">
                                <label class="col-form-label">Title</label>
                                <input name="title" type="text" class="form-control  required" placeholder="Type here" value="{{@$testimonials->title}}">
                            </div>
                            <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pad-r">
                                <label class="col-form-label">Name</label>
                                <input name="name" type="text" class="form-control  required" placeholder="Type here" value="{{@$testimonials->name}}">
                            </div>
                            
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pad-r">
                                <label class="col-form-label">Problem </label>
                                <textarea name="problem" class="form-control required" rows="2" placeholder="Type here">{{@$testimonials->problem}}</textarea>
                            </div>
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pad-r">
                                <label class="col-form-label">Solution</label>
                                <textarea name="solution" class="form-control required" rows="2" placeholder="Type here">{{@$testimonials->solution}}</textarea>
                            </div>
                            
                            <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-5 col-12 pad-l imgdiv">
                                <span class="col-form-label">Image</span>
                                <input type="file" class="custom-file-input" id="customFile" name="image" style="display:none">
                                <label class="custom_file_label extrlft" for="customFile">Upload Image</label>
                                <div class="uplodpic uploadImg">
                                    @if(@$testimonials->image)
                                        <li><img src="{{asset('storage/app/testimonials/'.@$testimonials->image)}}" alt="Success Story Image"></li>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-3 col-12">
                                <label for="inputPassword" class="col-form-label hide_label" style="display:none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary search_btnUser">@if(@$testimonials) Update @else Save @endif</button>
                            </div>
                        </div>
                        <!--all_time_sho-->
                    </form>
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
        
        $('#faqform').validate({
            rules: {
                name: {required: true},
                title: {required: true},
                category_id: {required: true},
                subcategory_id: {required: true},
                problem: {required: true},
                solution: {required: true}
            },
            submitHandler:function(form){
               form.submit();
            },
        });
        $("#customFile").change(function () {
            $('.uploadImg').html('');
            let files = this.files;
            if (files.length > 0) {
                let exts = ['image/jpeg', 'image/png', 'image/gif'];
                let valid = true;
                $.each(files, function(i, f) {
                    if (exts.indexOf(f.type) <= -1) {
                        valid = false;
                        return false;
                    }
                });
                if (! valid) {
                    alert('Please choose valid image files (jpeg, png, gif) only.');
                    $("#customFile").val('');
                    return false;
                }
                $.each(files, function(i, f) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('.uploadImg').append('<li><img src="' + e.target.result + '" alt="Success Story Image"></li>');
                    };
                    reader.readAsDataURL(f);
                });
            }
            
        });
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