<?php

namespace App\Providers;

use App\Interfaces\ExternalAuthInterface;
use App\Services\BarAuthService;
use App\Services\BazAuthService;
use App\Services\FooAuthService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Str;

class ExternalAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ExternalAuthInterface::class, function () {
            if (Str::startsWith(request()->input('login', ''), BarAuthService::LOGIN_PREFIX)) {
                return app()->make(BarAuthService::class);
            } else if (Str::startsWith(request()->input('login', ''), BazAuthService::LOGIN_PREFIX)) {
                return app()->make(BazAuthService::class);
            } else if (Str::startsWith(request()->input('login', ''), FooAuthService::LOGIN_PREFIX)) {
                return app()->make(FooAuthService::class);
            } else {
                throw new \Exception('Login prefix not supported');
            }
        });
    }
}
