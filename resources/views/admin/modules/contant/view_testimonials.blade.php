@extends('admin.layouts.app')
@section('title')
View Success Stories
@endsection
@section('links')
@include('admin.includes.links')
<style>
.top-main-profile {

	float: left;

	width: 100%;

	border-radius: 5px;

	box-shadow:0px 0px 4px 1px rgba(78, 18, 138, 0.1);

	background: #fff;

	min-height: 120px;

}

.left-profiles {

	float: left;

	width: 28%;

	border-radius:5px 0 0 5px;

	border-right: 2px solid #ededed;

}

.profile-photo {

	float: left;

	width: 100%;

	padding: 20px;

	text-align: center;

	position: relative;

}

.freelancer-fav {

	position: absolute;

	width: 30px;

	height: 30px;

	background: #f8f1fe;

	border-radius: 50%;

	text-align: center;

	line-height: 30px;

	color: #ff6400;

	font-size: 15px;

	right: 20px;

}

.freelancer-fav:hover {

	background: #ff6400;

	color: #f8f1fe;

}

.profile-photo span {

	width: 150px;

	height: 150px;

	border-radius: 50%;

	overflow: hidden;

	position: relative;

	display: inline-block;

	margin-top: 5px;

	background: #ecebeb;

}

.profile-photo span img {

	position: absolute;

	top: 0;

	bottom: 0;

	left: 0;

	right: 0;

	max-height: 100%;

	max-width: 100%;

	width: auto;

	height: auto;

	margin: auto;

}

.profile-dtls {

	float: left;

	width: 100%;

	padding: 0 8px 20px;

	text-align: center;

}

.profile-dtls h4 {

	color:#520d8b;

	font-weight: 400;

	font-size: 19px;

	font-family: 'Roboto', sans-serif;

	margin-bottom: 3px;

}

.profile-dtls p {

	color: #384749;

	font-weight: 400;

	font-size: 16px;

	font-family: 'Roboto', sans-serif;

	margin-bottom: 5px !important;

}

.profiles-rating li {

	float: none;

	margin-right: 0px;

	color: #000;

	font-size: 15px;

	display: inline-block;

}

.profiles-rating li a img {

	width:25px;

}

.profiles-rating li:last-child {

	margin-left: 10px;

	margin-right: 0px;

}
.blog-dates {

	position: absolute;

	top: 0;

	right: 0;

	width: 75px;

	background: #ff6400;

	text-align: center;

}

.blog-dates span {

	font-size: 25px;

	font-weight: 500;

	padding: 8px;

	color: #fff;

	display: inline-block;

	line-height: 30px;

	font-family: 'Roboto', sans-serif;

}

.blog-dates p {

	color: #1e2325;

	font-size: 18px;

	font-weight: 500;

	font-family: 'Roboto', sans-serif;

	background: #c3c8c8;

	padding: 2px;

}
.blog-image {
	display: inline-block;
	height: 320px;
	background: #f2f1f1;
	overflow: hidden;
	position: relative;
	width: 100%;
}
.blog-image img {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	max-width: 100%;
	max-height: 100%;
	width: auto;
	height: auto;
	margin: auto;
}
.success-box h4 {
	font-size: 18px !important;
}
.blogers {
	display: block;
	overflow: hidden;
    padding: 0;
}

.blogers li {
	color: #2d2d2d;
	font-size: 15px;
	font-weight: 400;
	margin-right: 15px;
	display: inline-block;
}

.blogers li img {
	margin-right: 7px;
	float: left;
	margin-top: 5px;
	width: 14px;
}

.success-box h5 {
	font-size: 16px;
	margin-bottom: 4px;
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
<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">View Success Stories</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manage.testimonials')}}" class="breadcrumb-link">Manage Success Stories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Success Stories</li>
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
                <h5 class="card-header">View Success Stories<a class="adbtn btn btn-primary" href="{{route('manage.testimonials')}}"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a></h5>
                <div class="card-body">
                  <div class="blog-box success-box">
                        @if(@$testimonial->image)
                        <div class="blog-image">                    
                            <a href=""><img src="{{asset('storage/app/testimonials/'.@$testimonial->image)}}" alt="Success Story Image"></a>
                            
                            <div class="blog-dates">
                                <span>{{ date('d', strtotime(@$testimonial->created_at)) }} <br> {{ date('M', strtotime(@$testimonial->created_at)) }}</span>
                                <p>{{ date('Y', strtotime(@$testimonial->created_at)) }}</p>
                            </div>
                        </div>
                        @endif
                        <h4>{{@$testimonial->title}}</h4>
                        <div class="blog-dtls" style="margin-top: 0px;">
                        <div class="user_ddtls" style="margin-bottom: 10px;">
                            
                        <h3>{{@$testimonial->name}}</h3>
                        </div>
                            <ul class="blogers">
                                <li><img src="{{asset('public/images/blog-icon2.png')}}" alt="Category Icon">  {{@$testimonial->getCategory->name}}</li>
                                <li><img src="{{asset('public/images/blog-icon2.png')}}" alt="Category Icon">{{@$testimonial->getSubategory->name}}</li>
                                <li><i class="fas fa-calendar" aria-hidden="true"></i> {{ date('d-M-Y', strtotime(@$testimonial->created_at)) }}</span></li>
                                <ul class="fot-socials ffr_fpp ppllc blg_social">
                                    <div class="addthis_inline_share_toolbox_2aqf float-right" data-url=""></div>
                                </ul>
                            </ul>
                            <h5>Problem</h5>
                            <p>{{@$testimonial->problem}}</p>
                            <h5>Solution</h5>
                            <p>{{@$testimonial->solution}}</p>
                        
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
                        $('.uploadImg').append('<li><img src="' + e.target.result + '"></li>');
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