<!doctype html>
<html>
    <head>
        <title>Firmogram</title>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/select2.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/application.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/font-awesome.css') }}">
        <script src="{{ url('assets/js/vendor/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/lodash.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/select2.min.js') }}"></script> 
        <script src="{{ url('assets/js/vendor/jquery.dataTables.min.js') }}"></script>    
    </head>

    <body>
        @include('shared._top_nav_bar')
        @include('shared._top_nav_bar2')
        
        @if (empty(Route::current()->getName())) 
        <section class="breadcrumpsSection">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            <li><a href="{{url()}}">Home</a></li>
                            <li>{{(isset($project_name)) ? $project_name : $currentUser}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <div class="container main-body">
            <div class="row">
                <div class="col-md-12">
                    @include('shared._notifications')
                    {{ $content }}
                </div>
            </div>
        </div>
        @include('shared._footer_nav_bar')
        <script src="{{ url('assets/js/application.js') }}"></script>
        <script>
            window.currentUser = {{ json_encode($currentUser) }};
            $(document).ready(function() { $("select").select2(); });
        </script>
    </body>
</html>