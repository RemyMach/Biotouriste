<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Mail;

class MailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\Mail', function(){
            return new Mail();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
