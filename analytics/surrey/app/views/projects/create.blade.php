<section class="projects-edit">
    <h1 class="title">Create New Project</h1>

    <form class="form-horizontal" enctype="multipart/form-data" role="form" action="{{ route('projects.store') }}" method="post">

    	@if(isset($step) && $step==1)
        	@include('projects._form', ['names'=>['name'=>'name','file'=>'file']])
        @else
        	@include('projects._form_step2')
        @endif


		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		        <button type="submit" class="btn btn-primary">Save</button>
		        <a href="{{ route('projects.index') }}" type="submit" class="btn btn-default">Cancel</a>
		    </div>
		</div>

    </form>
</section>