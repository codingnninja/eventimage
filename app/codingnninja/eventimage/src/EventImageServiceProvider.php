<?php

/*
 * This file is part of the Laravel Paystack package.
 *
 * (c) Prosper Otemuyiwa <prosperotemuyiwa@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Codingnninja\Eventimage;

use Illuminate\Support\ServiceProvider;

class EventimageServiceProvider extends ServiceProvider
{

    /*
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    /**
    * Publishes all the config file this package needs to function
    */
    public function boot()
    {
        $config = realpath(__DIR__.'/../resources/config/eventimage.php');

        $this->publishes([
            $config => config_path('eventimage.php')
        ]);
    }

    /**
    * Register the application services.
    */
    public function register()
    {
        $this->app->bind('eventimage', function () {

            return new EventImageBuilder;

        });
    }

    /**
    * Get the services provided by the provider
    * @return array
    */
    public function provides()
    {
        return ['eventimage'];
    }
}
