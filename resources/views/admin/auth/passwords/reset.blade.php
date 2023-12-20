<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('public/admin/images/fav.png')}}" type="image/x-icon">
    <title>Dignified Me :: Admin | Reset Password</title>
     @include('admin.includes.links')
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <div class="splash-container">
        <div class="card ">
            @include('admin.includes.message')
            <div class="card-header text-center"><a href="javascript:;"><img class="logo-img" src="{{asset('public/admin/images/logo.png')}}" alt="logo"></a><span class="splash-description">Reset Password</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.password.update') }}" aria-label="{{ __('Login') }}" id="Reset">
                    @csrf
                    <input type="hidden" name="id" value="{{Request::segment(4)}}">
                    <div class="form-group">
                        <input class="form-control form-control-lg required" id="password" type="password" placeholder="password" name="password">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg required" id="confirm_password" type="password" placeholder="confirm password" name="confirm_password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Reset Password</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <div class="card-footer-item card-footer-item-bordered">
                        <a href="{{route('admin.login')}}" class="footer-link">Login</a>
                    </div>
                </div>
            </div>
        </div>  
    <script src="{{asset('public/admin/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            validator = $('#Reset').validate({
                rules:{
                password: { required: true},
                confirm_password : {equalTo : "#password"}
               },
               submitHandler:function(form){
                   form.submit();
                },
            });
        });
    </script>
</body>
</html>