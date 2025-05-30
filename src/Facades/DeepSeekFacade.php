<?php

namespace Jacksmall\LaravelDeepseek\Facades;

use Illuminate\Support\Facades\Facade;

class DeepSeekFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'laravel-deepseek';
    }
}