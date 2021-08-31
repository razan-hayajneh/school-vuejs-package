<?php

namespace VueSystem\School;

use Illuminate\Support\ServiceProvider;

class SchoolServiceProvider extends ServiceProvider{
    public function boot(){
        // $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        // $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->publishes([
            __DIR__.'/resources' => resource_path(''),
        ], 'school-vue');
        $this->publishes([
            __DIR__.'/http' => app_path('http')
        ], 'school-http');
        $this->publishes([
            __DIR__.'/traits' => app_path('traits')
        ], 'school-http');
        $this->publishes([
            __DIR__.'/policies' => app_path('policies')
        ], 'school-policies');
        $this->publishes([
            __DIR__.'/providers' => app_path('providers')
        ], 'school-providers');
        $this->publishes([
            __DIR__.'/middleware' => app_path('http/middleware')
        ], 'school-middleware');
        $this->publishes([
            __DIR__.'/routes/web.php' => base_path('routes/web.php')
        ], 'school-web');
        $this->publishes([
            __DIR__.'/models' => app_path('models')
        ], 'school-models');
        $this->publishes([
            __DIR__.'/actions/fortify' => app_path('actions/fortify')
        ], 'school-fortify');
        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations')
        ], 'school-migrations');
        $this->publishes([
            __DIR__.'/public' => public_path(''),
        ], 'school-public');
    }
    public function register()
    {

    }

}
