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
    (function(i, s, o, g, r, a, m) {
        i["GoogleAnalyticsObject"] = r;
        (i[r] =
            i[r] ||
            function() {
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
    .heade_bg {
        background-color: #262626 !important;
    }
    </style>
</head>

<body>
    <div class="wrapper-page">
                    @include('admin.includes.message')
        <div class="panel panel-color panel-primary panel-pages">
            <div class="panel-heading rm08 heade_bg">
                <img style="margin: 10px 0 10px 0;" class="logo-img" src="{{asset('public/admin/images/logo.png')}}"
                    alt="logo">
            </div>

            <div class="panel-body">
                <form method="POST" action="{{ route('admin.password.email') }}" class="forgotePassword text-center">
                    @csrf

                    <div class="form-group m-b-0">
                        <div class="input-group">
                            <input
                                class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }} required"
                                id="email" type="text" placeholder="Enter Email Address" value="{{ old('email') }}"
                                autocomplete="off" name="email">

                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Reset</button>
                            </span>
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
    <script src="{{asset('public/admin/js/jquery.validate.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        validator = $('.forgotePassword').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(form) {
                form.submit();
            },
        });
    });
    </script>
</body>

</html>