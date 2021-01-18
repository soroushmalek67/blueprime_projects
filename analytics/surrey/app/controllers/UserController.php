<?php

class UserController extends BaseController
{

	protected $viewBase = 'users';

	public function __construct()
	{
		$this->beforeFilter('@authorize', ['only' => ['edit', 'update', 'destroy']]);
		$this->beforeFilter('@authorizeInvite', ['only' => ['store', 'create']]);
	}

	public function index()
	{
		$users = $this->currentUser()->viewers;
		$this->view('index', compact('users'));
	}

	public function create()
	{
		$this->view('create');
	}

	public function store()
	{
		$invite = new UserInvite($this->currentUser()->id, Input::get('user'));

		if($invite->save()) {
			return Redirect::route('users.index')
				->withSuccess('User Invited Successfully');
		} else {
			$this->view('create', ['user' => $invite->getUser()])
				->withErrors($invite->getErrors());
		}
	}

	public function edit(User $user)
	{
		$this->view('edit', compact('user'));
	}

	public function update(User $user)
	{
		$change = new UserChange($user, Input::get('user'));
	
		if ($change->save()) {
			return Redirect::route('users.index')
				->withSuccess('User updated successfully');
		} else {
            $this->view('edit', ['user' => $change->getUser()])
                ->withErrors($change->getErrors());
		}
	}

	public function destroy(User $user)
	{
		$user->delete();
		return Redirect::route('users.index')
			->withSuccess('User deleted successfully');	
	}

	public function authorize($route, $request)
	{
		$allowed = App::make('canI')->can('manage', $route->parameter('users'));

		if(! $allowed) {
			return App::abort(401);
		}
	}

	public function authorizeInvite($route, $request)
	{
		$allowed = CanI::can('invite', 'User');

		if (! $allowed) {
			return App::abort(401);
		}
	}

}

