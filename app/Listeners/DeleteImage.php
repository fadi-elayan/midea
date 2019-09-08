<?php

namespace App\Listeners;

use App\Events\PostDelete;
use App\Image;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteImage
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
        foreach ($event->images as $image)
        {
            Image::deleteImage($image);
        }
    }
}
