

<section class="projects-index">
    @if ($projects)
    <div class="table-responsive">
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
                                <img src="{{url('images/trash.png')}}">
                            </a>
                            <a href="{{ route("projects.edit", [$project->id]) }}" class="btn btn-default">
                                <img src="{{url('images/edit.png')}}">
                            </a>
                            <a href="{{ route("projects.duplicate", [$project->id]) }}" class="btn btn-default duplicat">
                                <img src="{{url('images/dup.png')}}"> Duplicate
                            </a>
                        </td>
                        @endif
                        <td>
                            <a href="{{ route("maps.show", [$project->id]) }}" class="btn btn-default">
                                <img src="{{url('images/geo.png')}}"> Geo-Map
                            </a>
                            <a href="{{ route("eco", [$project->id]) }}" class="btn btn-default @if($project->company_count>Config::get('app.company_count_threshold')) disabled @endif">
                                <img src="{{url('images/eco.png')}}"> Eco-system
                            </a>
                            <a href="{{ route("treemap", [$project->id]) }}" class="btn btn-default">
                                <img src="{{url('images/tree.png')}}"> Tree-Map
                            </a>
                            <a href="{{ route("analytics", [$project->id]) }}" class="btn btn-default">
                                <img src="{{url('images/anal.png')}}"> Analytics
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</section>
