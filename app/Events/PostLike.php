<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostLike
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data = array();
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
