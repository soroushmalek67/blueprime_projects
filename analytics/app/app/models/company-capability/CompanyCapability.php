<?php

class CompanyCapability extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'company_capabilities';

	protected $hidden = ['created_at', 'updated_at'];
	
	protected $fillable = ['project_id', 'company_id', 'title', 'description'];
	

	public static function boot()
	{
		parent::boot();
	} 


	public function delete()
	{
		parent::delete();
	}
	
}