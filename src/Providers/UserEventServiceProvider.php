<?php

namespace ConfrariaWeb\User\Providers;

use ConfrariaWeb\User\Listeners\CreateAccountCache;
use ConfrariaWeb\User\Listeners\DestroyAccountCache;
use ConfrariaWeb\User\Listeners\SendCreatedUserNotification;
use ConfrariaWeb\User\Events\UserCreatedEvent;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
            SendCreatedUserNotification::class
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
