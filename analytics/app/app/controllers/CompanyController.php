<?php

class CompanyController extends BaseController
{

	protected $viewBase = 'companies';


	public function show(ProjectCompany $company)
	{
		$company->capabilities = $company->capabilities();
		$company->details = $company->details();

		return View::make('companies.show', compact('company'));
	}

	public function destroy(ProjectCompany $company)
	{
		if($company->matching_source == "user_companies")
		{
			UserCompany::find($company->matching_company_id)->delete();
		}

		$company->delete();

		return Response::json("success", 200);
	}

	public function showVisual($type, $id)
	{
		$company = DB::table($type)->where('id', '=', $id)->first();
		$projectCompany = ProjectCompany::where("matching_source", "=", $type)
											->where("matching_company_id", "=", $id)->first();

		$projectCompanyId = $projectCompany->id;
		$projectId = $projectCompany->project_id;
		Session::flash('projectId', $projectId);

		$this->view('showVisual', compact('company', 'type', 'projectCompanyId'));
	}

	public function dndtree($id)
	{
		$company = ProjectCompany::find($id);

		$response = $company->getDndtree();

		return Response::json($response, 200);
	}
}