<section class="users-edit">
    <div class="loginFormCont registrationFormCont">
        <form class="form-horizontal" role="form" action="{{ route('users.store') }}" method="post">
        <div class="row">
            <div class="col-sm-12 text-center headingh1">
                <h1 class="headingh1">Invite Users</h1>
            </div>
            @include('users._form')
        </form>
    </div>
</section>
