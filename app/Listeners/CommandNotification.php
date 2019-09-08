<?php

namespace App\Listeners;

use App\Command;
use App\Events\PostCommand;
use App\Post;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CommandNotification
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


    public function handle(PostCommand $event)
    {
        $event->command_id = (Command::getCommend($event->data['post_id'], Auth::user()->id))[0]->id;
        User::findOrFail(Post::findOrFail($event->data['post_id'])->user_id)->notify(new \App\Notifications\CommendsNotification($event->data ,$event->command_id));
    }
}
