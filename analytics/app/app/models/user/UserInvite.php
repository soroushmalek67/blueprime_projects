<?php

class UserInvite
{
    use FormObject;

    protected $user;

    public function __construct($admin_id, $params)
    {
        $params['admin_id'] = $admin_id;
        $this->user      = new User($params);
        $this->validator = Validator::make($params, [
            'email' => 'required|email|unique:users,email',
            'name'  => 'required',
            'password' => 'required'
        ]);
        $this->validator->sometimes('password', 'required|min:8|confirmed', function($input) {
            return $input->password;
        });
    }

    public function save()
    {
        $success = false;
        $this->user->active   = true;

        if ($this->isValid()) {
            $success = (bool) $this->user->save();
        }

        return $success;
    }

    public function getUser()
    {
        return $this->user;
    }
}
