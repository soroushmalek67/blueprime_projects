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

    
	public function show() {
// 		DB::statement('ALTER TABLE `users` ADD `company_logo` VARCHAR(255) NOT NULL AFTER `company`');
            $project = Project::orderBy('id', 'DESC')->first();
			if(Input::has('project_id')) {
				$project_id = Input::get('project_id');
	            $project = Project::find($project_id);
			}
            
            $id = $project->id;
            
            $companies = $project->getCompanies();
            $capabilities = count($project->capabilities());
            
            $revenueArray = array_map((function ($array) {
            	return $array->revenue;
            }), $companies);
            
            $revenue = array_sum($revenueArray);
            
            $project_name = $project->name;
            
            if(ProjectCompany::where('project_id', '=', $id)->count() > Config::get('app.company_count_threshold'))
                    $exceededThreshold = true;
            else
                    $exceededThreshold = false;
            
            View::share('project_name', $project_name);
            $this->view('index', compact("project", "companies", 'project_name', 'id', 'exceededThreshold', 
            		'capabilities', 'revenue'));
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
	
	public function Profile () {
		$userDetails = $this->currentUser();
		$this->view('profile', compact('userDetails'));
	}
	
	public function ProfileUpdate () {
		$userID = $this->currentUser()->id;
		$destinationPath = "img/company_logos";
		
		$userDetails = Input::get('user');
		$file = Input::file('company_logo');
		
		if (empty($userDetails['name'])) {
			return Redirect::to('profile')->withErrors('Name field is required');
		}
		$user = User::find($this->currentUser()->id);
		$userUpdateArray = ['name' => $userDetails['name'], 'company' => $userDetails['company']];
		
		if ($file) {
			$oldLogo = $user->company_logo;
			
			$extension = $file->getClientOriginalExtension();
			$fileName = $userID."_".rand(11111,99999).'.'.$extension;
			$file->move($destinationPath, $fileName);
	
		    if (!empty($oldLogo) && File::exists(public_path($destinationPath."/".$oldLogo))) {
		        File::delete($destinationPath."/".$oldLogo);
		    }
		    
		    $userUpdateArray['company_logo'] = $fileName;
		}


	    $user->fill($userUpdateArray);
	    $user->save();
	    
		return Redirect::to('profile')->withSuccess('Updated!');
		
	}

}
