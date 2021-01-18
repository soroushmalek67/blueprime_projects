<form class="form-signin" role="form" method="post" action="{{ route('signup.store') }}">
    <h1>Firmogram</h1>

    @include('shared._errors')

    <h3 class="form-signin-heading">Sign up</h3>

    <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ Input::get('name') }}" required>
    <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ Input::get('email') }}" required>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
</form>