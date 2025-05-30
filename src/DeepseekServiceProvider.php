<?php

namespace Jacksmall\LaravelDeepseek;

use Illuminate\Support\ServiceProvider;
use Jacksmall\LaravelDeepseek\Services\Client;

class DeepseekServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/deepseek.php', 'deepseek');
        $this->app->bind('laravel-deepseek', function ($app) {
            return new Client($app->make(\GuzzleHttp\Client::class), $app['config']['deepseek']);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/deepseek.php' => config_path('deepseek.php'),
        ], 'deepseek-config');
    }
}
