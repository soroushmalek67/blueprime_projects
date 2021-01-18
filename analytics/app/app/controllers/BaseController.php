<?php

class BaseController extends Controller {

	protected $layout = 'layouts.application';
	protected $viewBase;
	protected $currentUser;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function view($viewName, $data = [])
	{
		$view = View::make("{$this->viewBase}.{$viewName}", $data);
		$this->layout->content = $view;
		return $view;
	}

	protected function shardView($viewName, $data = [])
	{
		$view = View::make("shared.{$viewName}", $data);
		$this->layout->content = $view;
		return $view;
	}

	protected function currentUser()
	{
		if (! $this->currentUser) {
			$this->currentUser = Auth::user() ?: new Guest(); 
		}

		return $this->currentUser;
	}
}
