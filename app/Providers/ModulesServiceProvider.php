<?php

namespace App\Providers;



use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {
    /**
     * Will make sure that the required modules have been fully loaded
     *
     * @return void routeModule
     */
    public function boot() {
        // For each of the registered modules, include their routes and Views
        $modules=config("module.modules");

        foreach($modules as $module) {

            // Load the routes for each of the modules


            if (file_exists(base_path().'/app/Modules/'.$module.'/routes.php')) {

                include base_path().'/app/Modules/'.$module.'/routes.php';
            }

            if (is_dir(base_path().'/app/Modules/'.$module.'/Views')) {

                $this->loadViewsFrom(base_path().'/app/Modules/'.$module.'/Views',$module);
            }

            if (is_dir(base_path().'/app/Modules/'.$module.'/Views/auth')) {

                $this->loadViewsFrom(base_path().'/app/Modules/'.$module.'/Views/auth',$module);
            }

        }

    }

    public function register() { }

}