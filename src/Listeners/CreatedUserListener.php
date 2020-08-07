<?php

namespace ConfrariaWeb\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CreatedUserListener implements ShouldQueue
{

    protected $historic;

    public function handle($event)
    {
        Log::info($event);
    }

}