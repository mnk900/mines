<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['home.*','blog.*','events.*','gallery.*'],function($view){
            $view->with('pages', \App\Models\Page::orderBy('_lft')->get()->toTree());
        });
    }
}
