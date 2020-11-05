<?php

namespace App\Providers;

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
        // register the services that are only used for development

        /**
         * Backpack Class Overrides
         * Reads as: instead of class X, use class Y
         */
        $this->app->bind(
            \Backpack\NewsCRUD\app\Http\Controllers\Admin\ArticleCrudController::class,
            \App\Http\Controllers\Admin\ArticleCrudController::class
        );
    }
}
