<?php

namespace App\Listeners;

use App\Events\PostCreate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatePost
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
     * @param  PostCreate  $event
     * @return void
     */
    public function handle(PostCreate $event)
    {
        \App\Post::uploadPost($event->request);
    }
}
