<?php

namespace App\Listeners;

use App\Channel\NotificationAcceptFrind;
use App\Events\AcceptFrindRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class NotificationAccepted
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
     * @param  AcceptFrindRequest  $event
     * @return void
     */
    public function handle(AcceptFrindRequest $event)
    {
        event(new NotificationAcceptFrind($event->user_id , $event->frind_id , Auth::user()->name));
    }
}
