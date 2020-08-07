<?php

namespace ConfrariaWeb\User\Providers;

use Illuminate\Auth\Events\Registered;
use ConfrariaWeb\User\Listeners\RegisteredUserListener;
use ConfrariaWeb\File\Listeners\UploadFileListener;
use ConfrariaWeb\User\Events\UserCreatedEvent;
use ConfrariaWeb\User\Events\UserCreatingEvent;
use ConfrariaWeb\User\Events\UserDeletedEvent;
use ConfrariaWeb\User\Events\UserUpdatedEvent;
use ConfrariaWeb\User\Listeners\CreatedHistoricUserListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use ConfrariaWeb\User\Listeners\CreatedUserListener;

class UserEventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            RegisteredUserListener::class
        ],
        UserCreatedEvent::class => [
            CreatedUserListener::class,
            UploadFileListener::class,
            CreatedHistoricUserListener::class,
        ],
        UserUpdatedEvent::class => [
            UploadFileListener::class,
            CreatedHistoricUserListener::class,
        ],
        UserDeletedEvent::class => [
            UploadFileListener::class,
            CreatedHistoricUserListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
