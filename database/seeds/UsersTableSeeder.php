<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = ['admin', 'customer'];

        foreach ($roles as $role) {
	        Role::create([
	        	'name' => $role
	        ]);
        }

        $admin = new User;
        $admin->name = 'Administrator';
        $admin->email = 'admin@catering';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->attachRole('admin');

        for ($i=1; $i <= 20; $i++) {
            $user = new User;
            $user->name = 'Example User '.$i;
            $user->email = 'exuser-'.$i.'@catering';
            $user->password = bcrypt('exuser');
            $user->save();
            $user->attachRole('customer');
            $user->createProfile();
        }
    }
}
