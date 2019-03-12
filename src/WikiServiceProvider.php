<?php

namespace Awes\Wiki;

use Config;
use Illuminate\Support\ServiceProvider;

class WikiServiceProvider extends ServiceProvider
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
        Config::set('docs.path', realpath(__DIR__ . '/../docs'));
    }
}
