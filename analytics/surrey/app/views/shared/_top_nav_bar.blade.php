<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

        @if(in_array(Route::current()->getName(), ['maps.show', 'projects.show', 'eco', 'treemap', 'analytics']))
          <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"></span> Projects <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('projects.index') }}">Dashboard</a></li>
                    @foreach($userProjects as $project)
                    <li>
                    @if(Route::current()->getName()=="eco" && $project->company_count>Config::get('app.company_count_threshold'))
                        <span class="nav-span">{{$project->name}}</span>
                    @else
                        <a href="{{ route(Route::current()->getName(), [$project->id]) }}">{{$project->name}}</a>
                    @endif
                    </li>
                    @endforeach
                </ul>
            </li>
           </ul>
        @else
            <a class="navbar-brand" href="{{ route('projects.index') }}"><span class="glyphicon glyphicon-list"></span> Projects</a>
        @endif

      <!-- <a class="navbar-brand" href="{{ route('projects.index') }}"><span class="glyphicon glyphicon-list"></span> Projects</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        @if ($isLoggedIn)
        @if(in_array(Route::current()->getName(), ['maps.show', 'projects.show', 'companies.type.show', 'eco', 'treemap', 'analytics']))
        <?php
            if(Route::current()->getName() == 'companies.type.show') {
                $currentProjectId = Session::get('projectId');
            } else {
                $segs = explode("/", Request::url());
                $currentProjectId = $segs[count($segs)-1];
            }
        ?>
        <ul class="nav navbar-nav">
            <li>
                <a href="{{ route("projects.show", [$currentProjectId]) }}"><span class="glyphicon glyphicon glyphicon-th-list"></span> Data</a>
            </li>

            <li>
                <a href="{{ route("maps.show", [$currentProjectId]) }}"><span class="glyphicon glyphicon-globe"></span> Geo-Map</a>
            </li>

            <li>
                <a href="{{ route("eco", [$currentProjectId]) }}"><span class="glyphicon glyphicon-dashboard"></span> Eco-system</a>
            </li>

            <li>
                <a href="{{ route("treemap", [$currentProjectId]) }}"><span class="glyphicon glyphicon-th"></span> Tree-Map</a>
            </li>

            <li>
                <a href="{{ route("analytics", [$currentProjectId]) }}"><span class="glyphicon glyphicon-stats"></span> Analytics</a>
            </li>

        </ul>    
        @endif
        
        <ul class="nav navbar-nav navbar-right">
            @if($canI('invite', 'User'))
            <li>
                <a href="{{ route('users.index') }}"><span class="glyphicon glyphicon-user"></span> Viewers</a>
            </li>
            @endif

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if($currentUser == 'Surrey')
                    <img src="{{url('assets/img/surrey-60.jpg')}}">
                    @else
                    {{ $currentUser }}
                    @endif
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('sessions.destroy') }}" data-method="delete"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </li>

        @else
            <li><a href="{{ route('sessions.create') }}">Sign in</a></li>
        @endif

        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
