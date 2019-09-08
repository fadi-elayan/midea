<?php

namespace App\Listeners;

use App\Events\DeletePostLike;
use App\Like;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class DeletePostlikes
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
        Like::deleteLike(Like::findOrFail(DB::table('likes')
            ->where('user_id' , $event->data['user_id'])
            ->where('post_id' , $event->data['post_id'])
            ->get()[0]->id));


    }
}
