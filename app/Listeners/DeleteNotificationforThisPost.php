<?php

namespace App\Listeners;

use App\Events\PostDelete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class DeleteNotificationforThisPost
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
     * @param  PostDelete  $event
     * @return void
     */
    public function handle(PostDelete $event)
    {

        (DB::table('notifications')
            ->where('data' , 'like' ,'%"post_id":"'.$event->post->id.'"%'))
            ->delete();
    }
}
