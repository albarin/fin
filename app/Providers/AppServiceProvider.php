<?php

namespace App\Providers;

use App\Http\Responses\CustomRedirector;
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

        $this->app->singleton('redirect', function ($app) {
            $redirector = new CustomRedirector($app['url']);

            if (isset($app['session.store'])) {
                $redirector->setSession($app['session.store']);
            }

            return $redirector;
        });
    }
}
