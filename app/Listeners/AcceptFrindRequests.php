<?php

namespace App\Listeners;

use App\Events\AcceptFrindRequest;
use App\Frind;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptFrindRequests
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
        Frind::insertFriend($event->user_id , $event->frind_id);
    }
}
