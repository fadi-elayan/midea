<?php

namespace App\Listeners;

use App\Events\DeletePostCommand;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeleteCommandNotification
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

          DB::table('notifications')
            ->where('data' , 'like' ,'%"user_id":'.strval(Auth::user()->id).',"post_id":"'.strval($event->post_id).'","command_id":'.strval($event->command_id).'%')
            ->delete();
    }
}
