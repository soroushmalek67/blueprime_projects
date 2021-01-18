<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/application.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/sign-in.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">
    </head>

    <body>
        <div class="container">
            {{ $content }}
        </div>

@include('shared._footer_nav_bar')
        
        <script src="{{ url('assets/js/vendor/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/bootstrap.min.js') }}"></script>
    </body>
</html>