<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \View;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        View::composer('layouts.app', 'App\Http\ViewComposers\AppComposer');
        View::composer('layouts.admin', 'App\Http\ViewComposers\AdminComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
