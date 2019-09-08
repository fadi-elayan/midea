<?php

namespace App\Channel;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationAcceptFrind
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $friend;
    public $name;
    public function __construct($user_id , $friend , $name)
    {
        $this->user_id = $user_id;
        $this->friend = $friend;
        $this->name = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['my-channel2'];
    }

    public function broadcastAs()
    {
        return 'my-event2';
    }
}
