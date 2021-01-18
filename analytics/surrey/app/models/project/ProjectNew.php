<?php

class ProjectNew
{
    use FormObject;

    protected $project;


    public function __construct($owner_id, $name, $type)
    {
        $params = [
            'owner_id' => $owner_id,
            'name'     => $name,
            'type'     => $type
        ];

        $this->project      = new Project($params);
        $this->validator = Validator::make($params, [
            'name' => 'required'
        ]);
    }

    public function save()
    {
        $success = false;

        if ($this->isValid()) {
            $success = $this->project->save();
        }

        return ($success) ? $this->project->id : 0;
    }


    public function getProject()
    {
        return $this->project;
    }
}