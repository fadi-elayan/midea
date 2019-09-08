<?php

namespace App\Listeners;

use App\Command;
use App\Events\DeletePostCommand;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletePostCommands
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
     * @param  DeletePostCommand  $event
     * @return void
     */
    public function handle(DeletePostCommand $event)
    {
        (Command::find($event->command_id))->delete();
    }
}
