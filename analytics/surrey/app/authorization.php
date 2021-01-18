<?php

$canI = new CanI\CanI(Auth::user());

if (Auth::check()) {
    if (Auth::user()->isAdmin()) {

        $canI->allow('invite', 'User');

        $canI->allow('manage', 'User', function($user) {
            return $this->getUser()->id === $user->admin;
        });

        $canI->allow('create', 'Project');

        $canI->allow('show', 'Project', function($project) {
            return $this->getUser()->id === $project->owner_id;
        });

        $canI->allow('manage', 'Project', function($project) {
            return $this->getUser()->id === $project->owner_id;
        });

    } else {
        
        $canI->allow('show', 'Project', function($project) {
            return $this->getUser()->admin()->id === $project->owner_id;
        });
    }
}

App::instance('canI', $canI);
