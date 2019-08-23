<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExtraBusinessUpdated
{
    use InteractsWithSockets, SerializesModels;

    public $extraBusiness;

    /**
     * Create a new event instance.
     *
     * @param $extraBusiness
     */
    public function __construct($extraBusiness)
    {
        $this->extraBusiness = $extraBusiness;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
