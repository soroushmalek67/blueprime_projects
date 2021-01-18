<?php

class ProjectController extends BaseController
{

	protected $viewBase = 'projects';

	public function __construct()
	{
		$this->beforeFilter('@authorizeShow', ['only' => ['show', 'visual', 'treemap', 'analytics']]);
		$this->beforeFilter('@authorizeCreate', ['only' => ['create', 'store']]);
		$this->beforeFilter('@authorizeManage', ['only' => ['edit', 'update', 'destroy', 'duplicate']]);
	}

	public function index()
	{
		if($this->currentUser()->isAdmin())
			$projects = $this->currentUser()->getProjects();
		else
			$projects = $this->currentUser()->admin()->getProjects();
		
		$this->view('index', compact('projects'));
	}

	
	public function show(Project $project)
	{
		
		if(Route::currentRouteName() == "api.projects.show"){
			$capabilities = $project->capabilities();
			$companies = $project->getApiCompanies();
			$filters = $project->getFilters();
			return Response::json(compact("project", "capabilities", "companies", "filters"), 200);
		}
		else {
			$companies = $project->getCompanies();
			$this->view('show', compact("project", "companies"));
		}
			
	}


	public function create()
	{
		$this->view('create', ["step" => 1]);
	}

	public function store()
	{
		$useDBColumns = ['name'];
		$fileOnlyColumns = Company::getColumns();
		if(Input::has('step') && Input::get('step')=="1")
		{
			$headers = array();
			if(Input::hasFile('file'))
			{
				$companiesImport = new ProjectCompanyImport(Input::file('file'));
				$headers = $companiesImport->getHeaders();
				Input::file('file')->move("/tmp", "file-".$this->currentUser()->id);
			}
			$this->view('create', [ 
				'project' => Input::all(), 
				'step' 	  => 2,
				'columns' => (Input::get('type')=="firmogram_companies") ? $useDBColumns : $fileOnlyColumns,
				'headers' => $headers
			]);
		}
		else
		{
			$type = Input::has('type') ? Input::get('type') : "firmogram_companies";
			$headers = Input::get('headers');

			if( ($msg = $this->isValidHeaders($headers)) !== "success") 
			{
				$companiesImport = new ProjectCompanyImport("/tmp/file-".$this->currentUser()->id);
				$originalHeaders = $companiesImport->getHeaders();
				$this->view('create', [ 
					'project' 	  => Input::all(), 
					'step'    	  => 2,
					'columns' 	  => (Input::get('type')=="firmogram_companies") ? $useDBColumns : $fileOnlyColumns,
					'headers' 	  => $originalHeaders,
					'old_headers' => $headers,
					'error'   	  => $msg
				]);
			}
			else
			{
				$capabilities = (Input::has('capabilities')) ? Input::get('capabilities') : array();

				$new = new ProjectNew($this->currentUser()->id, Input::get('name'), $type);
				if($id = $new->save()) {
					if(file_exists("/tmp/file-".$this->currentUser()->id)){
						$companiesImport = new ProjectCompanyImport("/tmp/file-".$this->currentUser()->id, $id, $type);
						$companiesImport->import($headers, $capabilities);
						unlink("/tmp/file-".$this->currentUser()->id);
					}

					return Redirect::route('projects.index')
						->withSuccess('Project Created Successfully');
				} else {
					$this->view('create', ['project' => $new->getProject()])
						->withErrors($new->getErrors());
				}
			}
		}
	}

	public function edit(Project $project)
	{
		$this->view('edit', compact('project'));
	}

	public function update(Project $project)
	{

		$change = new ProjectChange($project, Input::get('project'));
	
		if ($change->save()) {
			return Redirect::route('projects.index')
				->withSuccess('Project updated successfully');
		} else {
            $this->view('edit', ['project' => $change->getProject()])
                ->withErrors($change->getErrors());
		}
	}

	public function duplicate($id)
	{
		$project = Project::find($id);

		if($project->duplicate()) {
			return Redirect::route('projects.index')
				->withSuccess('Project duplicated successfully');
		} else {
			return Redirect::route('projects.index')
				->withError('Failed to duplicate, please try again');
		}
	}

	public function destroy(Project $project)
	{
		$project->delete();
		return Redirect::route('projects.index')
			->withSuccess('Project deleted successfully');	
	}


	public function visual($id)
	{
		$project = Project::find($id);

		$response = $project->getVisual();
		
		return Response::json($response, 200);		
	}


	public function treemap($id)
	{
		$project = Project::find($id);

		$response = $project->getTreemap();

		return Response::json($response, 200);
	}


	public function analytics($id)
	{
		$project = Project::find($id);
	
		$response = $project->getAnalytics();

		return Response::json($response, 200);
	}	


	public function authorizeShow($route, $request)
	{
		$allowed = App::make('canI')->can('show', $this->project($route));

		if(! $allowed) {
			return App::abort(401);
		}		
	}

	public function authorizeCreate($route, $request)
	{
		$allowed = CanI::can('create', 'Project');

		if (! $allowed) {
			return App::abort(401);
		}
	}

	public function authorizeManage($route, $request)
	{
		$allowed = App::make('canI')->can('manage', $this->project($route));

		if(! $allowed) {
			return App::abort(401);
		}
	}


	private function isValidHeaders($headers)
	{
		$required = [
			$headers['name'], 
			$headers['postal'],
			$headers['naics'],
		];

		if( in_array("null", $required) ) {
			return "fields: name, postal and naics are required";
		}


		$values = array_values($headers);
		$duplicates = array_unique(array_diff_assoc($values, array_unique($values)));
		$duplicatesString = "";
		foreach ($duplicates as $duplicate) {
			if($duplicate !== "null")
				$duplicatesString .= $duplicate.", ";
		}

		if($duplicatesString !== "") {
			return "Duplicated Fields: ".rtrim($duplicatesString, ", ");
		}

		return "success";
	}


	private function project($route)
	{
		if($route->parameter('projects')) {
			return $route->parameter('projects');
		} 

		return Project::find($route->parameter('id'));
	}
}