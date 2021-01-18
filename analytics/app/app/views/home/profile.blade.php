<section class="users-edit">
    <div class="loginFormCont registrationFormCont">
        <form class="form-horizontal" role="form" action="{{ url('profile') }}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12 text-center headingh1">
                <h1 class="headingh1">Update Profile</h1>
            </div>
            
            @include('shared._errors')

		    <div class="col-sm-12 loginFormSectionNwForm">
                <div class="row">
                    <div class="loginFormSectionNwFormInner clearfix">
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                                <input type="text" name="user[name]" class="form-control" id="name" placeholder="Name" value="{{ isset($userDetails->name)?$userDetails->name:'' }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/form_icon_email.png') }}"></span>
                                <input type="text" name="user[company]" class="form-control" id="company" placeholder="Company Name" value="{{ isset($userDetails->company)?$userDetails->company:'' }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group login-field">
                                <span><img src="{{ asset('img/front/form_icon_email.png') }}"></span>
                                <input type="text" name="user[email]" disabled class="form-control" id="email" placeholder="Email" value="{{ isset($userDetails->email)?$userDetails->email:'' }}">
                            </div>
                        </div>
						<div class="row">
							<div class="col-sm-6 registrationFormFieldCont">
							    <label>Company Logo</label>
	<!-- 						    <div class="input-group input-group-lg"> -->
	<!-- 						        <span class="input-group-btn input-group-lg"> -->
	<!-- 						            <span class="btn btn-primary btn-file"> -->
	<!-- 						                <img src="{{ asset('img/front/browse.jpg') }}">&nbsp; Browse  -->
	<!-- 						                <input type="file" name="company_logo" id="file"> -->
	<!-- 						            </span> -->
	<!-- 						        </span> -->
	<!-- 						    </div> -->
							                <input type="file" name="company_logo" id="file">
							</div>
							<div class="col-sm-6">
								@if (!empty($userDetails->company_logo))
									<img src="{{url('img/company_logos/'.$userDetails->company_logo)}}" alt=""/ width="200">
								@endif
							</div>
						</div>
<!-- 		                        <div class="col-sm-12"> -->
<!-- 		                            <div class="input-group login-field"> -->
<!-- 		                                <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span> -->
<!-- 		                                <input type="password" name="user[password]" class="form-control" id="password" placeholder="Password"> -->
<!-- 		                            </div> -->
<!-- 		                        </div> -->
<!-- 		                        <div class="col-sm-12"> -->
<!-- 		                            <div class="input-group login-field"> -->
<!-- 		                                <span><img src="{{ asset('img/front/password-login-icon.png') }}"></span> -->
<!-- 		                                <input type="password" name="user[password_confirmation]" class="form-control" id="password_confirmation" placeholder="Confirm Password"> -->
<!-- 		                            </div> -->
<!-- 		                        </div> -->
                        <div class="text-center submit-btn-auth">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('users.index') }}" type="submit" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
		        </div>
		    </div>
		</div>
            
            
            
        </form>
    </div>
</section>
