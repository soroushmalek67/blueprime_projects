@include('shared._errors')

    <div class="col-sm-12 loginFormSectionNwForm">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="loginFormSectionNwFormInner clearfix">
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                <input type="text" name="user[name]" class="form-control" id="name" placeholder="Name" value="{{ isset($user->name)?$user->name:'' }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/form_icon_email.png') }}"></span>
                                <input type="text" name="user[email]" class="form-control" id="email" placeholder="Email" value="{{ isset($user->email)?$user->email:'' }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                <input type="password" name="user[password]" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span>
                                <input type="password" name="user[password_confirmation]" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="text-center submit-btn-auth">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('users.index') }}" type="submit" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>