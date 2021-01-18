<section class="users-edit">
    <h1 class="title">Invite User</h1>

    <form class="form-horizontal" role="form" action="{{ route('users.store') }}" method="post">
        @include('users._form')
    </form>
</section>
