<?php

namespace App\Listeners;

use App\Events\AddFrindRequest;
use App\Channel\NotificationEvent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class AddFrindRequestNotification
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
     * @param  AddFrindRequest  $event
     * @return void
     */
    public function handle(AddFrindRequest $event)
    {
        User::findOrFail($event->user_id)->notify(new \App\Notifications\FrindRequestNotification($event->user_id , $event->frind_id));
        event(new NotificationEvent($event->user_id , count(User::getNotification($event->user_id)) , Auth::user()->name));
    }
}
