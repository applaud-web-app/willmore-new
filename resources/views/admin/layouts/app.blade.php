<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{asset('public/admin/assets/images/favicon.png')}}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('links')
    <title>WillAndMore :: Admin | @yield('title')</title>
</head>
<body class="fixed-left">
    <div id="wrapper">
       @yield('headers')
       @yield('sidebar')
       <div class="content-page">
            @yield('content')
            @yield('footer')
        </div>
    </div>
    @yield('script')
</body>
</html>
