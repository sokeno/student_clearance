<?php

namespace App\Providers;

use App\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::if('hasRole', function ($role) {
            return Auth::user()->hasRole($role);
        });

        Blade::if('userInSameDepartment', function ($department) {

			if(Auth::guest()){
				return false;
			}

			$user = Auth::user();	

            if ($user->hasRole('admin')) {
                return true;
            }

            if ($user->hasRole('staff')) {
                return Staff::whereUserId($user->id)->first()->department == $department;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
