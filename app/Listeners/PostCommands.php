<?php

namespace App\Listeners;

use App\Command;
use App\Events\PostCommand;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class PostCommands
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
     * @param  PostCommands  $event
     * @return void
     */
    public function handle(PostCommand $event)
    {
        $event->command_id = Command::uploadCommand($event->data);
    }
}
