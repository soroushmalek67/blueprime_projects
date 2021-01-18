<?php

class SessionController extends BaseController
{
	protected $layout 	= "layouts.account";
	protected $viewBase = "sessions";

	public function create()
	{
		$this->view('create');
	}

	public function store()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required|alphaNum|min:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('sessions.create')
				->withErrors($validator) 
				->withInput(Input::except('password'));
		} else {

			$fields = array_merge(Input::only('email', 'password'), ['active' => true]);

			if (Auth::attempt($fields, Input::get('remember'))) {
				return Redirect::intended()
					->withSuccess('Signed in successfully');
			} else {
				return Redirect::route('sessions.create')
					->withError('Invalid email or password')
					->withInput(Input::except('password'));
			}
		}
	}


	public function storeGuest()
	{
		$rules = array(
			'email'    => 'required|email'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('sessions.create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$guest = User::where('email', '=', Input::get('email'))->first();
			
			if($guest && $guest->password != '') {
				return Redirect::route('sessions.create')
					->withError('You are a registered user, please login with your password')
					->withInput(Input::except('password'));
			}

			if (Guest::login(Input::get('email'), $guest)) {
				return Redirect::intended()
					->withSuccess('Signed in successfully');
			} else {
				return Redirect::route('sessions.create')
					->withError('Invalid email')
					->withInput(Input::except('password'));
			}
		}
	}

	public function destroy()
	{
		$redirect = Redirect::route('sessions.create');

		if(Auth::check()) {
			Auth::logout();
			return $redirect->withSuccess('Signed out successfully');
		} else {
			return $redirect;
		}
	}
}


