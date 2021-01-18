<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	protected $fillable = [
		'email', 
		'name', 
		'password', 
		'admin_id',
		'logins_counter'
	];


	public function projects()
	{
		return $this->hasMany('Project', 'owner_id');
	}


	public function getProjects()
	{
		return DB::table('projects')
					->leftJoin('project_companies', 'project_companies.project_id', '=', 'projects.id')
					->where('projects.owner_id', '=', $this->id)
					->select(DB::raw('projects.id, projects.name, projects.type, projects.owner_id, count(project_companies.id) as company_count, "Project" as class'))
					->groupBy('projects.id')
					->get();
	}

	public function viewers()
	{
		return $this->hasMany('User', 'admin_id');
	}


	public function admin()
	{
		return User::find($this->admin_id);
	}

	public static function boot()
	{
		parent::boot();

		static::saving(function($model){
			if ($model->isDirty('password')) {
				$model->password = Hash::make($model->password);
			}
		});
	} 


	public function isAdmin()
	{
		return $this->admin;
	}

	public function getAdminAttribute($value)
	{
		return (bool) $value;
	}

	public function delete()
	{
		parent::delete();
	}

	public function __toString()
	{
		return $this->name;
	}

}

