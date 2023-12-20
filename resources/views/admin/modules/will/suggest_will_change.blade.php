@extends('admin.layouts.app')
@section('title')@endsection
@section('links')
@include('admin.includes.links')
<style>
    .about-info-p {
    width: 100%;
}
.panel .panel-body p {
    font-size: 15px;
}
.info-panel-will{
    display: flex;
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
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.dashboard')}}">Will and More</a></li>
                    <li class="active">Suggest Will Change</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Will Information</h3>
                                    <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.will')}}" >
                                    Back
                                    </a>
                                </div>

                                <div class="panel-body info-panel-will">
                                    <div class="about-info-p">
                                        <strong>Will ID :</strong>
                                        <p class="text-muted">#{{@$wills->id ? @$wills->id : '-'}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>Package Name :</strong>
                                        <p class="text-muted">{{@$wills->getPackage ? @$wills->getPackage->packageDetail->package_name : '-'}}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <strong>User Name :</strong>
                                        <p class="text-muted" style="word-break: break-word;">{{@$wills->userDetails ? $wills->userDetails->name : '-' }}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Start Date :</strong>
                                        <p class="text-muted">{{@$wills->start_date ? date('d.m.Y',strtotime(@$wills->start_date)) : '-'}}</p>
                                    </div>

                                    <div class="about-info-p m-b-0">
                                        <strong>Status :</strong>
                                        <p class="text-muted">
                                            @if(@$wills->status==1)
                                            In Progress
                                            @elseif(@$wills->status==2)
                                                Finalized
                                            @elseif(@$wills->status==3)
                                                Completed
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal-Information -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <!-- Personal-Information -->

                    <div class="panel panel-default panel-fill">
                        <div class="panel-heading">
                            <h3 class="panel-title">Suggest Will Changes <img src="{{asset('public/images/pagright.png')}}" alt="icon"> {{@$package->package_name}}</h3>
                            {{-- <a class="btn btn-primary waves-effect waves-light w-md" href="{{route('manage.will')}}" >Back</a> --}}
                        </div>

                        @include('admin.includes.message')
                        <div class="panel-body rm04">
                            <form id="create_changes" action="{{route('suggest.will.change')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <input type="hidden" name="will_id" id="will_id" value="{{@$wills->id}}">
                                <input type="hidden" name="user_id" id="user_id" value="{{@$wills->user_id}}">

                                <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Message</label>
                                        <textarea name="message" style="height: 100px;"  class="form-control">{{old('message')}}</textarea>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="form-group col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12">
                                    <label for="ProfileImg" class="col-form-label">Attachment</label>
                                    <input id="ProfileImg" type="file" class="form-control" name="attachments">
                                    {{-- <div class="uplodpic uplodprofilepic  upld-fix" style="margin-top: 10px;">
                                        <img src="">
                                    </div> --}}
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <!-- Personal-Information -->
            </div>
        </div>

        @if(count(@$willMessage) >0)
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Suggested </h3>
                                </div>
                            </div>
                            <!-- Personal-Information -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>

        @foreach (@$willMessage as $message)
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default panel-fill">

                                <div class="panel-body info-panel">

                                    <div class="about-info-p">
                                        <p class="text-muted"><strong>Suggested By</strong>: {{@$message->adminDetails ? $message->adminDetails->name : '-' }}</p>
                                    </div>

                                    <div class="about-info-p">
                                        <p class="text-muted"><strong>Date</strong>: {{@$message->created_at ? date('d.m.Y',strtotime(@$message->created_at)) : '-'}}</p>
                                    </div>

                                    <div class="about-info-p">

                                        <p class="text-muted" style="word-break: break-word;">
                                        <strong>Message</strong>: {{@$message->message}}</p>
                                    </div>

                                    @if(@$message->attachments != null)

                                            @if(strpos(@$message->attachments,'jpg') ||
                                            strpos(@$message->attachments,'jpeg') ||
                                            strpos(@$message->attachments,'png')
                                            )
                                        <p class="text-muted" style="word-break: break-word;">
                                            <strong>Attachments</strong>:
                                        <div class="about-info-img">
                                            <img src="{{url('storage\app\admin\will_message')}}\{{@$message->attachments}}" alt="">
                                        </div>
                                    @else
                                            <p class="text-muted" style="word-break: break-word;">
                                                <strong>Attachments</strong>:
                                            <a href="{{url('storage\app\admin\will_message')}}\{{@$message->attachments}}" target="_blank">View</a>
                                    @endif
                                    @endif

                                </div>
                            </div>
                            <!-- Personal-Information -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        @endforeach
        @endif

    </div>
</div>
<!-- container -->
</div>
<!-- content -->



@endsection
@section('footer')
@include('admin.includes.footer')
@endsection
@section('script')
@include('admin.includes.scripts')
<script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $(function() {
            $("#ProfileImg").change(function() {
                $('.uplodprofilepic').html('');
                let files = this.files;

                if (files.length > 0) {
                    let exts = ['image/jpeg', 'image/png', 'image/gif', 'application/msword', 'application/vnd.ms-excel', 'text/plain', 'application/pdf'];
                    let valid = true;
                    $.each(files, function(i, f) {
                        if (exts.indexOf(f.type) <= -1) {
                            valid = false;
                            return false;
                        }
                    });
                    if (!valid) {
                        alert('Please choose valid files (jpeg, png, gif, pdf, doc, xlsx, text) only.');
                        $("#ProfileImg").val('');
                        return false;
                    }
                    $.each(files, function(i, f) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.uplodprofilepic').append('<img src="' + e.target.result +'">');
                        };
                        reader.readAsDataURL(f);
                    });
                }

            });
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#create_changes').validate({
            rules: {
                message:{
                    required:true,
                },
            },
            submitHandler:function(form){
               form.submit();
            },
        });

    });
</script>
@endsection
