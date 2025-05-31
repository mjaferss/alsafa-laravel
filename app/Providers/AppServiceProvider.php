<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set default locale to Arabic
        if (!session()->has('locale')) {
            session()->put('locale', 'ar');
        }
        app()->setLocale(session()->get('locale', 'ar'));
    }
}
