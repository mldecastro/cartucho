<?php

use App\Role;
Use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $admin = new User();

        $admin->name = 'Administrador';
        $admin->email = 'cartuchoeciasg@hotmail.com';
        $admin->password = bcrypt('a1b2c3d4e5');

        $admin->save();

        $admin->roles()->attach($role_admin);
    }
}
