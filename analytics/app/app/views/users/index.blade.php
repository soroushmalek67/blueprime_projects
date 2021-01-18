<section class="users-index">
    <header class="title">
        <div class="row">
            <div class="col-sm-10 headingh1">
                <h1>Users</h1>
            </div>
            <div class="col-sm-2">
                @if($canI('invite', 'User'))
                    <nav class="pull-right">
                        <a class="btn btn-primary" href="{{ route('users.create') }}">Invite New User</a>
                    </nav>
                @endif
            </div>
        </div>
    </header>
    @if ($users)
    <div class="users-index table-responsive">
        <table class="table table-striped table-bordered users">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="user">
                        <td>{{ $user->id }}</td>
                        <td>
                            @if ($user->name)
                                <a href="{{ route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
                            @else
                                <span class="label block label-danger">Invited</span>
                            @endif
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            @if($canI('manage', $user))
                                <a href="{{ route("users.edit", [$user->id]) }}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="{{ route("users.destroy", [$user->id]) }}" class="btn btn-danger destroy" data-method="delete">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</section>
