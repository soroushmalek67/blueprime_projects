<section class="projects-index">
    <header class="title">
        <div class="row">
            <div class="col-sm-10">
                <h1>Projects</h1>
            </div>
            <div class="col-sm-2">
                @if($canI('create', 'Project'))
                    <nav class="pull-right">
                        <a class="btn btn-primary" href="{{ route('projects.create') }}">Create New Project</a>
                    </nav>
                @endif
            </div>
        </div>
    </header>
    @if ($projects)
        <table class="table table-striped table-bordered projects">
            <thead>
                <th>Name</th>
                <th>Source</th>
                <th></th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($projects as $project)
                    <tr class="project">
                        <td>
                            <a href="{{ route("projects.show", $project->id) }}">{{ $project->name }}</a>
                        </td>
                        <td>
                            {{ $project->type }}
                        </td>
                        @if($canI('manage', $project))
                        <td>
                            <a href="{{ route("projects.destroy", [$project->id]) }}" class="btn btn-danger destroy" data-method="delete">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            <a href="{{ route("projects.edit", [$project->id]) }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="{{ route("projects.duplicate", [$project->id]) }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-paste"></span> Duplicate
                            </a>
                        </td>
                        @endif
                        <td>
                            <a href="{{ route("maps.show", [$project->id]) }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-globe"></span> Geo-Map
                            </a>
                            <a href="{{ route("eco", [$project->id]) }}" class="btn btn-default @if($project->company_count>Config::get('app.company_count_threshold')) disabled @endif">
                                <span class="glyphicon glyphicon-dashboard"></span> Eco-system
                            </a>
                            <a href="{{ route("treemap", [$project->id]) }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-th"></span> Tree-Map
                            </a>
                            <a href="{{ route("analytics", [$project->id]) }}" class="btn btn-default">
                                <span class="glyphicon glyphicon-stats"></span> Analytics
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</section>
