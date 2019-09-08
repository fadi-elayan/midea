<?php

namespace App\Listeners;

use App\Events\CancelFrindRequest;
use App\Frind;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteFrindReques
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
     * @param  CancelFrindRequest  $event
     * @return void
     */
    public function handle(CancelFrindRequest $event)
    {
        Frind::deleteFrind($event->frind_id);
        Frind::deleteFrind($event->user_id);
    }
}
