<?php

namespace ConfrariaWeb\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use ConfrariaWeb\User\Notifications\UserRegisteredNotification;

class RegisteredUserListener implements ShouldQueue
{
    public function handle($event)
    {
        //$event->user->notify(new UserRegisteredNotification());
    }

}