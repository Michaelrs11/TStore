<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //nyari si user berdasarkan rolenya
        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();

        //Data admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'address' => 'Jakarta',
            'gender' => 'male'
        ]);

        //Data user
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' =>bcrypt('users'),
            'address' => 'Bekasi',
            'gender' => 'female'
        ]);

        //ngeset data
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
