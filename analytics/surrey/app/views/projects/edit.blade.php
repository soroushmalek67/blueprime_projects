<section class="projects-edit">
    <h1 class="title">Edit Project</h1>

	@include('shared._errors')

    <form class="form-horizontal" role="form" action="{{ route('projects.update', $project->id) }}" method="post">
        
        <input type="hidden" name="_method" value="put">
		
		<div class="form-group">
		    <label for="name" class="col-sm-2 control-label">Name</label>
		    <div class="col-sm-10">
		        <input type="text" name="project[name]" class="form-control" id="name" placeholder="Project Name" value="{{ isset($project->name)?$project->name:'' }}">
		    </div>
		</div>
    
		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		        <button type="submit" class="btn btn-primary">Save</button>
		        <a href="{{ route('projects.index') }}" type="submit" class="btn btn-default">Cancel</a>
		    </div>
		</div>

    </form>
</section>