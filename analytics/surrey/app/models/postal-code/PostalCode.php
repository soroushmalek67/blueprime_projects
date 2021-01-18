<?php

class PostalCode extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'postal_codes';

	protected $fillable = ['postal', 'lat', 'lng', 'city', 'province'];

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