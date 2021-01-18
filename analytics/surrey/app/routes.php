<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('login',		['as' => 'sessions.create',	'uses' => 'SessionController@create']);
Route::post('login',	['as' => 'sessions.store',	'uses' => 'SessionController@store']);
Route::post('loginGuest',['as' => 'sessions.store.guest',	'uses' => 'SessionController@storeGuest']);
Route::delete('logout',	['as' => 'sessions.destroy',	'uses' => 'SessionController@destroy']);
Route::get('signup',	['as' => 'signup.create',	'uses' => 'SignupController@create']);
Route::post('signup',	['as' => 'signup.store',	'uses' => 'SignupController@store']);



Route::group(['before' => 'auth'], function(){
	Route::get('/', 'HomeController@show');
	Route::get('/d3', 'HomeController@d3');
	Route::get('/eco/{id}', 		['as' => 'eco', 	  'uses' => 'HomeController@eco']);
	Route::get('/treemap/{id}', 	['as' => 'treemap',   'uses' => 'HomeController@treemap']);
	Route::get('/analytics/{id}', 	['as' => 'analytics', 'uses' => 'HomeController@analytics']);

	Route::resource('users', 'UserController');
	Route::model('users', 'User');

	Route::get('api/projects/{id}/visual', 'ProjectController@visual');
	Route::get('api/projects/{id}/treemap', 'ProjectController@treemap');
	Route::get('api/projects/{id}/analytics', 'ProjectController@analytics');
	Route::resource('projects', 'ProjectController');
	Route::resource('api/projects', 'ProjectController');
	Route::model('projects', 'Project');
	Route::get('projects/duplicate/{id}', ['as' => 'projects.duplicate',  'uses' => 'ProjectController@duplicate']);


	Route::get('api/companies/{id}/dndtree', 'CompanyController@dndtree');
	Route::get('companies/{type}/{id}', ['as' => 'companies.type.show', 'uses' => 'CompanyController@showVisual']);
	Route::resource('companies', 'CompanyController');
	Route::model('companies', 'ProjectCompany');

	Route::resource('maps', 'MapController');

	Route::group(array('prefix' => 'admin'), function()
	{
		Route::get('/',			['as' => 'admin.home',	'uses' => 'AdminController@home']);
		Route::get('enrich/twitter-stats', ['as' => 'admin.enrich.twitter-stats', 'uses' => 'AdminController@enrichTwitterStats']);

		/*** To be merged with admin ***/
		Route::get('import',	['as' => 'admin.import.create',	'uses' => 'ImportController@create']);
		Route::post('import',	['as' => 'admin.import.import',	'uses' => 'ImportController@import']);
	});

});

View::composer('shared._notifications', function($view){
	$view->with('flash', [
		'success' => Session::get('success'),
		'error'	  => Session::get('error')
	]);
});


if(Auth::check()) {
	$currentUser = Auth::user();
	if($currentUser->isAdmin())
		$userProjects = $currentUser->getProjects();
	else
		$userProjects = $currentUser->admin()->getProjects();
} else {
	$currentUser = new Guest;
	$userProjects = [];
}


View::share('currentUser', $currentUser);
View::share('userProjects', $userProjects);
View::share('isLoggedIn', Auth::check());
View::share('canI', function($action, $entity) {
    return CanI::can($action, $entity);
});
