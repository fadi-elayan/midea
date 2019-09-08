<?php

namespace App\Listeners;

use App\Events\PostLike;
use App\Like;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Postlikes
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
     * @param  PostLike  $event
     * @return void
     */
    public function handle(PostLike $event)
    {

        Like::uploaudLike($event->data);
    }
}
