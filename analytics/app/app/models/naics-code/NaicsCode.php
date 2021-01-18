<?php

class NaicsCode extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'naics_codes';

	protected $fillable = ['naics', 'description'];

	protected $hidden = ['created_at', 'updated_at'];

	public static function boot()
	{
		parent::boot();
	} 


	public function delete()
	{
		parent::delete();
	}
	
}