<?php

namespace ConfrariaWeb\User\Listeners;

use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class CreateAccountCache
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
        Cache::forget('accountID');
        if(existsAccount()){
            Cache::put('accountID', Auth::user()->account_id, now()->addMinutes(600));
        }
    }
}