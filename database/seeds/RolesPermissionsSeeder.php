<?php

use Illuminate\Database\Seeder;
use App\Role;
use  App\User;
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
        try {
            $admin = new Role();
            $admin->name = 'admin';
            $admin->display_name = 'Administrator';
            $admin->save();

            $user = new Role();
            $user->name = 'user';
            $user->display_name = 'Regular User';
            $user->save();

            $adminRole = User::where('name', '=', 'admin')->first();
            $adminRole->roles()->attach($admin->id);

            $userRole = User::where('name', '=', 'user')->first();
            $userRole->roles()->attach($user->id);

            $unlimited = new Permission();
            $unlimited->name = 'unlimited';
            $unlimited->save();

            $view = new Permission();
            $view->name = 'view';
            $view->save();

            //$admin->attachPermmission($unlimited);
            //$user->attachPermission($view);
            $admin->perms()->sync(array($unlimited->id));
            $user->perms()->sync(array($view->id));
        }catch (Exception $e){
            echo "Roles admin and user filled in db\n";
        }
    }
}
