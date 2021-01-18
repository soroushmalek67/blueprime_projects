<?php

class Signup
{
    use FormObject;

    protected $user;
    protected $params;

    public function __construct($params)
    {
        $this->user = new User;
        $this->params = $params;

        $this->validator = Validator::make($params, [
            'name'              => 'required',
            'email'             => 'required|email',
            'password'          => 'required|min:8|confirmed'
        ]);
    }

    public function save()
    {
        if ($this->isValid()) {

            $this->user->admin  = true;
            $this->user->active = true;
            $this->user->fill([
                'name'     => $this->params['name'],
                'email'    => $this->params['email'],
                'password' => $this->params['password'],
            ]);

            $this->user->save();

            return true;
        }

        return false;
    }

    public function getUser()
    {
        return $this->user;
    }
}
