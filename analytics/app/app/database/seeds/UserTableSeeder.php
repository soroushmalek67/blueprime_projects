<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();

        $user = User::create([
            'name'            => "admin",
            'email'           => "admin@firmogram.com",
            'password'        => "admin",
            'active'          => true,
            'admin'           => 1
        ]);

        $admin_id = $user->id;
        $usernames = ['tdameh', 'second', 'third'];

        foreach($usernames as $username) {

            $user = User::create([
                'name'            => ucfirst($username),
                'email'           => "{$username}@firmogram.com",
                'password'        => $username,
                'active'          => true,
                'admin'           => 0,
                'admin_id'        => $admin_id
            ]);
        }

        $user = User::create([
            'name'            => "Surrey",
            'email'           => "surrey@firmogram.com",
            'password'        => "Surrey",
            'active'          => true,
            'admin'           => 1
        ]);       
    }
}
