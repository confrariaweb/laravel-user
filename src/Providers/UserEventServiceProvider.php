<?php

namespace ConfrariaWeb\User\Providers;

use Illuminate\Auth\Events\Attempting;
use ConfrariaWeb\User\Events\UserCreatedEvent;
use ConfrariaWeb\User\Listeners\CheckUserRoles;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use ConfrariaWeb\User\Listeners\CreateAccountCache;
use ConfrariaWeb\User\Listeners\DestroyAccountCache;

class UserEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Attempting::class => [
            DestroyAccountCache::class
        ],
        Login::class => [
            CreateAccountCache::class
        ],
        Logout::class => [
            DestroyAccountCache::class
        ],
        UserCreatedEvent::class => [
            CheckUserRoles::class
        ],
        Registered::class => [
            CheckUserRoles::class
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
