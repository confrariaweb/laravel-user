<?php

namespace ConfrariaWeb\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckUserRoles
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        if($user->roles->count() < 1){
            $role = config('cw_user.default_role');
            if ($role) {
                $user->roles()->attach($role);
            }
        }
    }
}
