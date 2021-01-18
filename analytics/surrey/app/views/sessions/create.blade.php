<center>
    <img src="{{url('assets/img/surrey.png')}}">
    <br><br><br><br><br>
    @include('shared._notifications')
</center>

<!--<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <form class="form-signin" role="form" method="post" action="{{ route('sessions.store.guest') }}">
            <h4 class="form-signin-heading">Sign in as a guest</h4>
            <input type="email" class="form-control" name="email" placeholder="Email address" value="" required autofocus>
            @if ($errors->has('email')) <p class="help-block alert-danger">{{ $errors->first('email') }}</p> @endif
            <button class="btn btn-lg btn-primary btn-block" type="submit">Guest Sign In</button>
        </form>
    </div> -->

        <form class="form-signin" role="form" method="post" action="{{ route('sessions.store') }}">
            <center><h3 class="form-signin-heading">Sign in</h3></center>
            <input type="email" class="form-control" name="email" placeholder="Email address" value="{{ Input::old('email') }}" required autofocus>
            @if ($errors->has('email')) <p class="help-block alert-danger">{{ $errors->first('email') }}</p> @endif
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            @if ($errors->has('password')) <p class="help-block alert-danger">{{ $errors->first('password') }}</p> @endif
            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            <a href="https://firmogram.com/get-started-2/" class="btn btn-lg btn-warning btn-block" role="button">Request a demo</a>
            <style>
            .btn-primary{
                background-color: #4682B4;
            }
            .btn-warning {
                color: #FFA500;
                background-color: #4682B4;
                border-color: #4682B4;
            }

            </style>
        </form>