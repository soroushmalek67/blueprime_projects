<?php

class MapController extends BaseController
{

	protected $viewBase = 'maps';

	public function show($id)
	{
		$project_name = Project::find($id)->name;
		$this->view('show', compact("id", "project_name"));
	}
}