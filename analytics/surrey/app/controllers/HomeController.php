<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    protected $viewBase = 'home';
    protected $layout   = 'layouts.application';

    
	public function show()
	{
		return Redirect::route('projects.index');
	}

	public function eco($id)
	{
		if(ProjectCompany::where('project_id', '=', $id)->count() > Config::get('app.company_count_threshold'))
			$exceededThreshold = true;
		else
			$exceededThreshold = false;
		
		$project_name = Project::find($id)->name;
		$this->view('eco', compact('id', 'project_name', 'exceededThreshold'));
	}

	public function treemap($id)
	{
		$project_name = Project::find($id)->name;
		$this->view('treemap', compact('id', 'project_name'));
	}	

	public function analytics($id)
	{
		$project_name = Project::find($id)->name;
		$this->view('analytics', compact('id', 'project_name'));
	}	


	public function d3()
	{
		$this->view('d3');
	}

}
