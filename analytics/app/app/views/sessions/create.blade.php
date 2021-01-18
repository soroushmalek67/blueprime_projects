<center>
    <a href="https://firmogram.com/"><img src="{{url('assets/img/surrey.png')}}" class="login-logo"></a>
</center>

    
<section class="loginFormSection loginFormSectionNw">
        <div class="loginFormCont registrationFormCont">
                <!--<form role="form" method="POST" action="{{ url('/auth/login') }}">-->
                <form role="form" method="POST" action="{{ route('sessions.store') }}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center sign-in-pen"><img src="{{asset('img/front/sign-in-pen.png')}}"></div>
                            <h1>Sign in</h1>
                            <!-- <h1><img src="{{ asset('img/front/signin_lock.png') }}" alt=""/> SIGN I<span>n</span></h1> -->
                        </div>
                        <div class="col-sm-12 loginFormSectionNwForm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="loginFormSectionNwFormInner clearfix">
                                            <div class="col-sm-12">
                                                <label>Username (Required)</label>
                                                <div class="input-group login-field">
                                                    <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                                    <input type="text" name="email" class="form-control" value="{{ Input::old('email') }}">
                                                    @if ($errors->has('email')) <p class="help-block alert-danger">{{ $errors->first('email') }}</p> @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label>Password (Required)</label>
                                                <div class="input-group login-field">
                                                    <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                                    <input type="password" name="password" class="form-control">
                                                    @if ($errors->has('password')) <p class="help-block alert-danger">{{ $errors->first('password') }}</p> @endif
                                                </div>
                                            </div>
                                            <div class="text-center submit-btn-auth">
                                                <input name="loginSubmit"  type="submit" value="Sign in">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            
</section>
   <!-- </div>
    <div class="col-md-3"></div>
</div> 

-->