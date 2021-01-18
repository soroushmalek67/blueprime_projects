<?php

class Project extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	protected $hidden = ['created_at', 'updated_at'];

	protected $fillable = ['name', 'type', 'owner_id'];


	public function owner()
	{
		return $this->belongsTo('User');
	}

	public function projectCompanies()
	{
		return $this->hasMany('ProjectCompany', 'project_id');
	}


	public function capabilities()
	{
		return DB::table('company_capabilities')
					->select('title')->distinct()
					->where('project_id', '=', $this->id)
					->get();
	}


	public function getCompaniesNamesAndDescriptios()
    {
    	return DB::table($this->type)
		    		->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
		    		->select($this->type.'.id', $this->type.'.name', $this->type.'.description', 'project_companies.matching_company_id')
		    		->where('project_companies.project_id', '=', $this->id)
		    		->where('project_companies.matching_source', 'LIKE', $this->type)
		    		->get();    

    }


	public function getApiCompanies()
    {
    	$companies = DB::table($this->type)
				    		->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
				    		->where('project_companies.project_id', '=', $this->id)
				    		->where('project_companies.matching_source', 'LIKE', $this->type)
				    		->where('lat', '!=', '0')
				    		->get();

		foreach ($companies as $company) {
			$capabilities = DB::table('company_capabilities')
								->select('title as capability')
								->where('company_id', '=', $company->id)
								->get();

			$company->capability =	array();
			foreach ($capabilities as $capability) {
				array_push($company->capability, $capability->capability);
			}

		}

		return $companies;
    } 


	public function getCompanies()
    {
    	return DB::table($this->type)
		    		->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
		    		->where('project_companies.project_id', '=', $this->id)
		    		->where('project_companies.matching_source', 'LIKE', $this->type)
		    		->get();
    }  

	public function getFilters()
	{

		$naics = DB::table($this->type)
			    		->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
			    		->select('naics', 'naics_description')->distinct()
			    		->where('project_companies.project_id', '=', $this->id)
			    		->where('project_companies.matching_source', 'LIKE', $this->type)
						->orderBy('naics', 'ASC')->get();

		$capability = DB::table('company_capabilities')
							->select('title as capability')->distinct()
							->where('project_id', '=', $this->id)
							->get();

		$town_center = DB::table($this->type)
							->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
							->select('town_center')->distinct()
							->where('project_companies.project_id', '=', $this->id)
				    		->where('project_companies.matching_source', 'LIKE', $this->type)
							->orderBy('town_center', 'ASC')->get();


		$city = DB::table($this->type)
						->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
						->select('city')->distinct()
						->where('project_companies.project_id', '=', $this->id)
			    		->where('project_companies.matching_source', 'LIKE', $this->type)
						->orderBy('city', 'ASC')->get();

		$province = DB::table($this->type)
							->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
							->select('province')->distinct()
							->where('project_companies.project_id', '=', $this->id)
			    			->where('project_companies.matching_source', 'LIKE', $this->type)
							->orderBy('province', 'ASC')->get();

		$country = DB::table($this->type)
							->join('project_companies', $this->type.'.id', '=', 'project_companies.matching_company_id')
							->select('country')->distinct()
							->where('project_companies.project_id', '=', $this->id)
			    			->where('project_companies.matching_source', 'LIKE', $this->type)
							->orderBy('country', 'ASC')->get();

		return array( "naics" => $naics,
					  "capability" => $capability, 
					  "town_center" => $town_center, 
					  "city" => $city, 
					  "province" => $province, 
					  "country" => $country );
	}


	public function getVisual()
	{

		$capabilities = $this->capabilities();

		//episodes
		$i = 1;
		foreach ($capabilities as $capability)
		{
			$capability->type = 'episode';
			$capability->name = $capability->title;
			$capability->description = $capability->title;
			$capability->episode = $i++;
			$capability->date = "";
      		$capability->slug = "";
      		$companies = array();
      		$companies[] = "";
			foreach(Capability::companies($this->id, $capability->title) as $company)
			{
				$companies[] = $company->name;
				$capability->links = $companies;
			}
			unset($capability->id);
      		unset($capability->title);
		}

		$themes = array();
		$perspectives = array();

		$i = 0;
		$companies = $this->getCompaniesNamesAndDescriptios();
		$length = count($companies);
		foreach ($companies as $company) {
			if ($i<($length/2)){
				$company->type = 'theme';
				$company->slug = url("/companies/$this->type/$company->matching_company_id");
				$themes[] = $company;				
			}
			else {
				$company->type = 'perspective';
				$company->slug = url("/companies/$this->type/$company->matching_company_id");
				$company->count = '10';
				$company->group = '1';
				$perspectives[] = $company;	
			}
			unset($company->id);
			$i++;
		}

		return [ 'episodes' => $capabilities, 'themes' => $themes, 'perspectives' => $perspectives ];		
	}


	public function getTreemap()
	{

		$totalCount = 0;
		$level0 = DB::select('	SELECT cc.title, TRIM(CONCAT(cc.title, " (", COUNT(pc.id), ")")) as name, COUNT(pc.id) as count
								FROM company_capabilities cc
								INNER JOIN project_companies pc on pc.id = cc.company_id
								WHERE cc.project_id = ?
								GROUP BY cc.title', [$this->id]);

		foreach ($level0 as $row0) {
			$totalCount += $row0->count;
			$row0->children = DB::select('	SELECT n.naics as naics, TRIM(CONCAT(n.description, " (", COUNT(uc.id), ")")) as name, COUNT(uc.id) as count
											FROM '.$this->type.' uc
											INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
											INNER JOIN naics_codes n on SUBSTRING(uc.naics,1,3) = n.naics
											INNER JOIN company_capabilities cc on cc.company_id = pc.id
											WHERE cc.title = ?  
											AND pc.project_id = ? AND pc.matching_source LIKE ?
											GROUP BY n.naics, n.description', [$row0->title, $this->id, $this->type] );

			foreach ($row0->children as $row1) {
				$totalCount += $row1->count;
				$row1->children = DB::select('	SELECT n.naics as naics, CONCAT(n.description, " (", COUNT(uc.id), ")") as name
												FROM '.$this->type.' uc
												INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
												INNER JOIN naics_codes n on SUBSTRING(uc.naics,1,4) = n.naics
												INNER JOIN company_capabilities cc on cc.company_id = pc.id
												WHERE cc.title = ?  
												AND pc.project_id= ? AND pc.matching_source LIKE ?  
												AND SUBSTRING(uc.naics,1,3) = ?
												GROUP BY n.naics, n.description', [$row0->title, $this->id, $this->type, $row1->naics] );
				unset($row1->naics);

				foreach ($row1->children as $row2) {
					$row2->children = DB::select('	SELECT pc.id as id, pc.matching_company_id as matching_company_id, uc.name as name, 
													REPLACE(REPLACE(REPLACE(LOWER(uc.name), " ", "-"), "(", "-"), ")", "-") as url
													FROM '.$this->type.' uc
													INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
													INNER JOIN company_capabilities cc on cc.company_id = pc.id
													WHERE cc.title = ?
													AND pc.project_id = ? AND pc.matching_source LIKE ? 
													AND SUBSTRING(uc.naics,1,4) = ?', [$row0->title, $this->id, $this->type, $row2->naics] );
					
					foreach ($row2->children as $row3) {
						$row3->url = url("/companies/user_companies/$row3->matching_company_id");
						unset($row3->matching_company_id);
						$row3->value = 1;
						$row3->size = 1;
					}
					unset($row2->naics);
				}
			}

		}


		if(empty($level0))
		{
			$level0 = DB::select('	SELECT n.naics as naics, TRIM(CONCAT(n.description, " (", COUNT(uc.id), ")")) as name, COUNT(uc.id) as count
											FROM '.$this->type.' uc
											INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
											INNER JOIN naics_codes n on SUBSTRING(uc.naics,1,3) = n.naics
											AND pc.project_id = ? AND pc.matching_source LIKE ?
											GROUP BY n.naics, n.description', [$this->id, $this->type] );

			$totalCount = $this->getTreemapNonCapLowLevels($level0);			
		}



		return ["name" => "All ($totalCount)", "children" => $level0];
	}


	private function getTreemapNonCapLowLevels($level)
	{
		$totalCount = 0;
		foreach ($level as $row1) {
			$totalCount += $row1->count;
			$row1->children = DB::select('	SELECT n.naics as naics, CONCAT(n.description, " (", COUNT(uc.id), ")") as name
											FROM '.$this->type.' uc
											INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
											INNER JOIN naics_codes n on SUBSTRING(uc.naics,1,4) = n.naics
											WHERE pc.project_id= ? AND pc.matching_source LIKE ?  
											AND SUBSTRING(uc.naics,1,3) = ?
											GROUP BY n.naics, n.description', [$this->id, $this->type, $row1->naics] );
			unset($row1->naics);

			foreach ($row1->children as $row2) {
				$row2->children = DB::select('	SELECT pc.id as id, pc.matching_company_id as matching_company_id, uc.name as name, 
												REPLACE(REPLACE(REPLACE(LOWER(uc.name), " ", "-"), "(", "-"), ")", "-") as url
												FROM '.$this->type.' uc
												INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
												WHERE pc.project_id = ? AND pc.matching_source LIKE ? 
												AND SUBSTRING(uc.naics,1,4) = ?', [$this->id, $this->type, $row2->naics] );
				
				foreach ($row2->children as $row3) {
					$row3->url = url("/companies/user_companies/$row3->matching_company_id");
					unset($row3->matching_company_id);
					$row3->value = 1;
					$row3->size = 1;
				}
				unset($row2->naics);
			}
		}

		return $totalCount;
	}

	public function getAnalytics()
	{
		$capabilitiesCount = DB::select('	SELECT title, count(company_id) as count
											FROM company_capabilities
											WHERE project_id = ?
											GROUP BY title', [$this->id] );


		$provincesStat = DB::select('	SELECT province, count(uc.id) as count, SUM(revenue) as revenue, SUM(employees) as employees
										FROM '.$this->type.' uc
										INNER JOIN project_companies pc on uc.id = pc.matching_company_id
										WHERE pc.project_id = ? AND pc.matching_source LIKE ? 
										GROUP BY province', [$this->id, $this->type] );


		$naicsCount = DB::select('	SELECT n.description as description, COUNT(uc.id) as count
									FROM '.$this->type.' uc
									INNER JOIN project_companies pc on uc.id = pc.matching_company_id 
									INNER JOIN naics_codes n on SUBSTRING(uc.naics,1,3) = n.naics 
									WHERE pc.project_id = ? AND pc.matching_source LIKE ? 
									GROUP BY description', [$this->id, $this->type] );

		$towncentersCount = DB::select('	SELECT town_center, count(uc.id) as count
											FROM '.$this->type.' uc
											INNER JOIN project_companies pc on uc.id = pc.matching_company_id
											WHERE pc.project_id = ? AND pc.matching_source LIKE ? 
											GROUP BY town_center', [$this->id, $this->type] );

		return compact('capabilitiesCount', 'provincesStat', 'naicsCount', 'towncentersCount');
	}


	public function getCompanyCount()
	{
		return DB::table('project_companies')
					->where('project_id', '=', $this->id)
					->count();
	}


	public function duplicate()
	{
		$this->name .= " (2)";
		$newProject = new Project($this->toArray());
		$newProject->save();

		foreach ($this->projectCompanies as $projectCompany) {
			if($projectCompany->matching_source == "user_companies") {
				$newUserCompany = new UserCompany(json_decode(json_encode($projectCompany->details()),true));
				$newUserCompany->save();
				$projectCompany->matching_company_id = $newUserCompany->id;
			}
			$projectCompany->project_id = $newProject->id;
			$newProjectCompany = new ProjectCompany($projectCompany->toArray());
			$newProjectCompany->save();
			foreach ($projectCompany->capabilities() as $capability) {
				$newCompanyCapability = new CompanyCapability([
												'project_id' => $newProject->id, 
												'company_id' => $newProjectCompany->id, 
												'title' => $capability->name]);
				$newCompanyCapability->Save();
			}
		}

		return true;
	}


	public static function boot()
	{
		parent::boot();
	} 

	public function delete()
	{
		$this->projectCompanies()->delete();
		parent::delete();
	}
}	
