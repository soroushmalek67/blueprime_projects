<?php

class ProjectChange
{
    use FormObject;

    protected $project;
    protected $params;

    public function __construct($project, $params)
    {
        $this->project   = $project;
        $this->params   = $params;

        $this->validator = Validator::make($params, [
            'name' => 'required'
        ]);

    }

    public function save()
    {
        $success = false;

        $this->project->fill($this->params);

        if ($this->isValid()) {
            $success = $this->project->save();
        }

        return $success;
    }

    public function getProject()
    {
        return $this->project;
    }

}