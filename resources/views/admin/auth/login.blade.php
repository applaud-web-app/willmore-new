<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <meta name="description" content="" />

    <meta name="author" content="Coderthemes" />

    <link rel="shortcut icon" href="{{asset('public/admin/assets/images/favicon.png')}}" />

    <title>Will and More</title>

    <link href="{{asset('public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/admin/assets/css/core.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/admin/assets/css/components.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/admin/assets/css/pages.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/admin/assets/css/menu.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('public/admin/assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />

    <script src="{{asset('public/admin/assets/js/modernizr.min.js')}}"></script>

    <script>
      (function (i, s, o, g, r, a, m) {
        i["GoogleAnalyticsObject"] = r;
        (i[r] =
          i[r] ||
          function () {
            (i[r].q = i[r].q || []).push(arguments);
          }),
          (i[r].l = 1 * new Date());
        (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m);
      })(
        window,
        document,
        "script",
        "../../www.google-analytics.com/analytics.js",
        "ga"
      );

      ga("create", "UA-65046120-1", "auto");

      ga("send", "pageview");
    </script>
<style>
    
.heade_bg{
  background-color: #262626!important;
}
</style>
</head>

<body>
    <div class="wrapper-page">
        @include('admin.includes.message')
        <div class="panel panel-color panel-primary panel-pages">
            <div class="panel-heading rm08 heade_bg">
            <img style="margin: 10px 0 10px 0;" class="logo-img" src="{{asset('public/admin/images/logo.png')}}" alt="logo">
            </div>

            <div class="panel-body">
                <form method="POST" id="SigninForm" class="form-horizontal m-t-20" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input
                                class="form-control input-lg form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }} required"
                                id="email" type="text" placeholder="Email Address" value="{{ @$email }}"
                                autocomplete="off" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input
                                class="form-control input-lg form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }} required"
                                id="password" type="password" placeholder="Password" name="password"
                                value="{{@$password}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <input class="custom-control-input" name="remember" id="checkbox-signup" type="checkbox"
                                    {{ @$remember ? 'checked' : '' }}>

                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <a href="javascript:;">
                                <button class="btn btn-primary btn-lg w-lg waves-effect waves-light rm01" type="submit">
                                    Log In
                                </button></a>
                        </div>
                    </div>

                    <div class="form-group m-t-30">
                        <div class="col-sm-12">
                            <a href="{{route('admin.password.request')}}" class="rm01"><i class="fa fa-lock m-r-5"></i> Forgot your
                                password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('public/admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/detect.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/fastclick.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/waves.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('public/admin/assets/js/jquery.app.js')}}"></script>
    <script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
    <script>
      var resizefunc = [];
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#SigninForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
            },

            submitHandler: function(form) {
                form.submit();
            },
        });
    });
    </script>
</body>

</html>