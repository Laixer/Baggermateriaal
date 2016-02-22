<?php

namespace App\Providers;

use \Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Auth::provider('portal', function() {
            return new \VLG\GSSAuth\PortalUserProvider(new User());
        });

        Auth::extend('portal', function($app, $name, array $config) {
            return new \VLG\GSSAuth\PortalGuard(Auth::createUserProvider($config['provider']));
        });
    }
}
