<section class="projects-edit">
    <h1 class="title headingh1">Edit Project</h1>

	@include('shared._errors')
<section class="projects-edit">
    <div class="loginFormCont registrationFormCont">
    <h4 class="title headingh1">Name</h4>
    <form class="form-horizontal" role="form" action="{{ route('projects.update', $project->id) }}" method="post">
        
        <input type="hidden" name="_method" value="put">
		
		<div class="form-group">
                    <div class="col-sm-12">
                        <div class="input-group login-field">
                            <span><img src="{{ asset('img/front/login-profile-img.png') }}"></span>
                            <input type="text" name="project[name]" class="form-control" id="name" placeholder="Project Name" value="{{ isset($project->name)?$project->name:'' }}">
                        </div>
                    </div>
		</div>
                
    
		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		        <button type="submit" class="btn btn-primary">Save</button>
		        <a href="{{ route('projects.index') }}" type="submit" class="btn btn-default">Cancel</a>
		    </div>
		</div>

    </form>
    </div>
</section>
</section>