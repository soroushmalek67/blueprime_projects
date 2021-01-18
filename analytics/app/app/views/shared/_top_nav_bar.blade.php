<nav class="top-navigation navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row top-menu">
        <div class="col-md-4 logo">
            <a href="{{url()}}"><img src="{{url('images/top-logo.png')}}"></a>  
        </div>
    
        <div class="col-md-8">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if ($isLoggedIn)
                <ul class="nav navbar-nav navbar-right">
                    @if($canI('invite', 'User'))
                    <li>
                        <a href="{{ route('users.index') }}"><span class="glyphicon glyphicon-user"></span> Viewers</a>
                    </li>
                    @endif

                    <li class="dropdown user-name">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{url('images/noprofile.png')}}" width="50px;" class="user-login">
                            {{ $currentUser }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><span class="glyphicon "></span> <a href="{{ url('profile') }}"> &nbsp; &nbsp; &nbsp; Profile</a></li>
                            <li><a href="{{ route('sessions.destroy') }}" data-method="delete"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </li>

                @else
                    <li><a href="{{ route('sessions.create') }}">Sign in</a></li>
                @endif

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
  </div><!-- /.container-fluid -->
</nav>
<script type="text/javascript">var URL = "{{ url() }}";</script>