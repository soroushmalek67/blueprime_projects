<?php

class Capability
{

	public static function companies($project_id, $title)
	{
		return DB::table('project_companies')
					->join('company_capabilities', 'project_companies.id', '=', 'company_capabilities.company_id')
					->select('name', 'project_companies.id', 'project_companies.matching_company_id')
					->where('company_capabilities.project_id', '=', $project_id)
					->where('company_capabilities.title', 'LIKE', $title)
					->get();
	}
}