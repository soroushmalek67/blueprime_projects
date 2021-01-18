<?php

class FirmogramCompany extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'firmogram_companies';

	protected $hidden = ['created_at', 'updated_at'];

	protected $fillable = [	'name',
				            'name_2',
				            'address', 
							'address_2',
							'town_center',
							'city',
							'postal', 
							'province',
							'country',
							'phone',
							'url',
				            'naics',
				            'naics_2',
				            'contact_1_first_name',
				            'contact_1_last_name',
				            'contact_2_first_name',
				            'contact_2_last_name',
				            'contact_3_first_name',
				            'contact_3_last_name',
				            'nationality',
				            'established_at',
				            'revenue',
				            'employees',
				            'services',
				            'description',
				            'lat',
				            'lng',
				            'naics_description',
				            'naics_2_description',
				            'database_name' ];


	public static function boot()
	{
		parent::boot();
	} 


	public function delete()
	{
		parent::delete();
	}
}
