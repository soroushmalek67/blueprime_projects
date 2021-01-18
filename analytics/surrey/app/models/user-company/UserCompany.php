<?php

class UserCompany extends Eloquent
{
	 /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_companies';

	protected $hidden = ['created_at', 'updated_at'];

	protected $fillable = [ 'name', 
							'address',
							'town_center', 
							'city', 
							'province', 
							'country', 
							'postal', 
							'lat', 
							'lng', 
							'phone',
							'url',
							'naics', 
							'employees',
							'revenue',
							'established_at',
							'services',
							'description',
							'linkedin_url',
							'facebook_url',
							'twitter_url',
							'twitter_followers',
							'twitter_following',
							'twitter_tweets',
							'naics_description' ];


	public static function boot()
	{
		parent::boot();
	} 


	public function delete()
	{
		parent::delete();
	}
	
}
