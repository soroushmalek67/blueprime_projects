<?php

class ImportController extends BaseController
{

	protected $viewBase = 'import';


	public function create()
	{
		$this->view('create');		
	}

	public function import()
	{
		if(Input::hasFile('file')){
			if(Input::get('type')=="postal"){
				$postalCodesImport = new PostalCodeImport(Input::file('file'));
				$postalCodesImport->import();
			} elseif(Input::get('type')=="naics") {
				$naicsCodesImport = new NaicsCodeImport(Input::file('file'));
				$naicsCodesImport->import();				
			} elseif(Input::get('type')=="firmogram_company") {
				$database_name = (Input::has('database_name')) ? Input::get('database_name') : "";
				$firmogramCompanyImport = new FirmogramCompanyImport(Input::file('file'), $database_name);
				$firmogramCompanyImport->import();				
			}

		}

		return Redirect::route('projects.index')
			->withSuccess('Imported Successfully');		
	}

}