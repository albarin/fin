<?php

namespace App\Providers;

use App\Money\Balance;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('hex_color', 'App\Validators\HexColorValidator@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Balance::class, function() {
            return new Balance(env('INITIAL_BALANCE'));
        });
    }
}
