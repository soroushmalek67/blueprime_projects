@include('shared._errors')

<input type="hidden" name="step" value="1"/>

<div class="col-sm-12">
    <div class="input-group login-field">
        <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
        <input type="text" name="{{$names['name']}}" class="form-control" id="name" placeholder="Project Name" value="{{ isset($project->name)?$project->name:'' }}">
    </div>
</div>

@if(false)
<div class="form-group">
    <label for="type" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-10">
        <input type="radio" name="type" value="firmogram_companies" checked> Use Firmogram Database<br>
        <input type="radio" name="type" value="user_companies"> Use Imported File Only
    </div>
</div>
@endif

<input type="hidden" name="type" value="user_companies">

<div class="col-sm-6 registrationFormFieldCont">
    <label>File input</label>
    <div class="input-group input-group-lg">
        <span class="input-group-btn input-group-lg">
            <span class="btn btn-primary btn-file">
                <img src="{{ asset('img/front/browse.jpg') }}">&nbsp Browse 
                <input type="file" name="{{$names['file']}}" id="file">
            </span>
        </span>
    </div>
    <p class="help-block">
    <div>Import companies for the project from <b>Windows Comma Separated</b> csv file format</div>
    <br>
    Fields accepted:
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;name, naics, service, address, city, province, country, postal, phone, employees and capabilities
    </p>
</div>


