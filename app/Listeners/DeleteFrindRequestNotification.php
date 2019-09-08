<?php

namespace App\Listeners;

use App\Events\CancelFrindRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class DeleteFrindRequestNotification
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
    public function handle($event)
    {
        (DB::table('notifications')
            ->where('type' , 'App\Notifications\FrindRequestNotification')
            ->where('data' ,'like' , '%"frind_id":'.$event->frind_id.',"user_id":"'.$event->user_id.'"%')
            ->delete());
    }
}
