<!doctype html>
<html>
    <head>
        <title>Firmogram</title>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/select2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/application.css') }}">
        <script src="{{ url('assets/js/vendor/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/lodash.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/select2.min.js') }}"></script> 
        <script src="{{ url('assets/js/vendor/jquery.dataTables.min.js') }}"></script>    
    </head>

    <body>
        @include('shared._top_nav_bar')

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('shared._notifications')
                    {{ $content }}
                </div>
            </div>

        </div>
        <script src="{{ url('assets/js/application.js') }}"></script>
        <script>
            window.currentUser = {{ json_encode($currentUser) }};
            $(document).ready(function() { $("select").select2(); });
        </script>
    </body>
</html>