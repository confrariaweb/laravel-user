<?php

namespace ConfrariaWeb\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Http\Request;

class CreateAccountSession
{
    protected $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($this->request->session()->exists('account')) {
            $this->request->session()->forget('account');
        }
        if(existsAccount()){
            $account = $event->user->accounts()->first();
            $this->request->session()->put('account', $account);
        }
    }
}