<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $adminRole = Role::firstOrCreate(['name'=>'admin', 'display_name' => 'Administrator']);
            $userRole = Role::firstOrCreate(['name'=>'user','display_name' => 'Regular User']);
 
            $admin = User::where('name', '=', 'admin')->first();
            $user = User::where('name', '=', 'user')->first();

            $admin->roles()->attach($adminRole->id);
            $user->roles()->attach($userRole->id);

            $unlimited = Permission::firstOrCreate(['name' => 'unlimited']);
            $view = Permission::firstOrCreate(['name' => 'view']);

            $adminRole->perms()->attach($unlimited->id);
            $userRole->perms()->attach($view->id);

    
    }
}
