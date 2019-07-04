<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    //use Braintree_Configuration;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Braintree_Configuration::environment('sandbox');
        \Braintree_Configuration::merchantId('3fmpqh6q5f2cyjxn');
        \Braintree_Configuration::publicKey('4r2c7gj87d7y79mh');
        \Braintree_Configuration::privateKey('e7119f66557f00d64af5e2f6ed747f66');
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
