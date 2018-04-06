<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class RuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
		    return preg_match('/^1[34578]\d{9}$/', $value);
	    });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
