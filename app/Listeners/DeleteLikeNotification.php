<?php

namespace App\Listeners;

use App\Events\DeletePostLike;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class DeleteLikeNotification
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
     * @param  DeletePostLike  $event
     * @return void
     */
    public function handle(DeletePostLike $event)
    {
            DB::table('notifications')
             ->where('data' , 'like' ,'%"user_id":'.$event->data['user_id'].',"post_id":"'.$event->data['post_id'].'"%')
             ->delete();
    }
}
