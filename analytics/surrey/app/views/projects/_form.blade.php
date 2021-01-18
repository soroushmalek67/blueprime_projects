@include('shared._errors')

<input type="hidden" name="step" value="1"/>

<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
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

<div class="form-group">
    <label for="file" class="col-sm-2 control-label">File input</label>
    <div class="col-sm-10">
    	<input type="file" name="{{$names['file']}}" id="file">
    	<p class="help-block">
            <div>Import companies for the project from <b>Windows Comma Separated</b> csv file format</div>
            <br>
            Fields accepted:
            <br>
            &nbsp;&nbsp;&nbsp;&nbsp;name, naics, service, address, city, province, country, postal, phone, employees and capabilities
        </p>
	</div>
</div>
