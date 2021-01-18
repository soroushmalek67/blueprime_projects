<?php

use Illuminate\Auth\UserInterface;

class Guest implements UserInterface
{
    public $id;
    public $name;
    public $exists = false;


    public static function login($email, $guest = null)
    {
        if($guest) {
            $guest->logins_counter = $guest->logins_counter + 1;
        } else {
            $adminUser = User::where('email', '=', Config::get('app.main_admin_user'))->first();

            $guest = new User([
                'email'          => $email,
                'name'           => $email, 
                'admin_id'       => $adminUser->id,
                'logins_counter' => 1
            ]);
        }

        $guest->save();
        Auth::login($guest);

        return true;
    }


    public function toArray()
    {
        return ['id' => $this->id, 'name' => $this->name];
    }

	public function getAuthIdentifier() {}
	public function getAuthPassword() {}
	public function getRememberToken() {}
	public function setRememberToken($value) {}
	public function getRememberTokenName() {}
}

