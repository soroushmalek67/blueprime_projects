<?php

class ProjectCompany extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_companies';

	protected $hidden = ['created_at', 'updated_at'];

	protected $fillable = [	'name',
				            'project_id',
				            'matching_source',
				            'matching_company_id' ];


	public function project()
	{
		return $this->belongsTo('Project', 'project_id');
	}

	public function capabilities()
	{
		return DB::table('company_capabilities')
					->select('title as name')
					->where('company_id', '=', $this->id)
					->get();
	}


	public function details()
	{
		return DB::table($this->matching_source)
					->where('id', '=', $this->matching_company_id)
					->first();
	}


	public function getDndTree()
	{
		$capabilities = $this->capabilities();
		foreach ($capabilities as $capability) {
			$capability->children  = Capability::companies($this->project_id, $capability->name);
		}

		return ['name' => $this->name, 'children' => $capabilities];
	}

	public static function boot()
	{
		parent::boot();
	} 


	public function delete()
	{
		parent::delete();
	}
}
