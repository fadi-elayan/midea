<?php

namespace App\Listeners;

use App\Events\PostLike;
use App\Post;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LikeNotification
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
        User::findOrFail(Post::findOrFail($event->data['post_id'])->user_id)->notify(new \App\Notifications\LikeNotification($event->data));
    }
}
