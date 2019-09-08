<?php

namespace App\Listeners;

use App\Events\PostDelete;
use App\Post;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletePost
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
        Post::deletePost($event->post);
    }
}
