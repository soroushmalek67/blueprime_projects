<section class="bottom-nev">
    <div class="container">
        <div class="row">
            <header class="title">
                <div class="col-sm-10">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
<!--                           @ if(in_array(Route::current()->getName(), ['maps.show', 'projects.show', 'eco', 'treemap', 'analytics', 'companies.type.show'])) -->
                            <ul class="nav navbar-nav menu-navigation-bar">
                              <li class="dropdown">
                                  <a href="#" class="navbar-brand dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-list"></span> Projects <b class="caret"></b></a>
                                  <ul class="dropdown-menu">
                                      @if (!empty(Route::current()->getName()))
                                      	  <li><a href="{{ url('/') }}">Dashboard</a></li>
                                      @else
                                      	  <li><a href="{{ url('projects') }}">All Projects</a></li>
                                      @endif
                                      @foreach($userProjects as $project)
                                      <li>
                                      @if(Route::current()->getName()=="eco" && $project->company_count>Config::get('app.company_count_threshold'))
                                          <span class="nav-span">{{$project->name}}</span>
                                      @else
                                      	  @if (empty(Route::current()->getName()) || Route::current()->getName() == 'companies.type.show')
                                          	  <a href="{{ url('?project_id='.$project->id) }}">{{$project->name}}</a>
                                          @else
                                          	  <a href="{{ route(Route::current()->getName(), [$project->id]) }}">{{$project->name}}</a>
                                          @endif
                                      @endif
                                      </li>
                                      @endforeach
                                  </ul>
                              </li>
                            @if(in_array(Route::current()->getName(), ['maps.show', 'projects.show', 'companies.type.show', 'eco', 'treemap', 'analytics']))
                            <?php
                                if(Route::current()->getName() == 'companies.type.show') {
                                    $currentProjectId = Session::get('projectId');
                                } else {
                                    $segs = explode("/", Request::url());
                                    $currentProjectId = $segs[count($segs)-1];
                                }
                            ?>
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
<!--                           @ else -->
<!--                               <a class="navbar-brand" href="{{ route('projects.index') }}"><span class="glyphicon glyphicon-list"></span> Projects</a> -->
<!--                           @ endif -->

                        <!-- <a class="navbar-brand" href="{{ route('projects.index') }}"><span class="glyphicon glyphicon-list"></span> Projects</a> -->
                    </div>
                </div>
                <div class="col-sm-2 create">
                    @if($canI('create', 'Project'))
                        <nav class="pull-right">
                            <a class="btn btn-primary create-new" href="{{ route('projects.create') }}">Create New Project</a>
                        </nav>
                    @endif
                </div>
            </header>
        </div>
    </div>
</section>