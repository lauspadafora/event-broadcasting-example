<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $msg;
    public $date;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $msg, $date)
    {
        $this->name = $name;
        $this->msg = $msg;
        $this->date = $date;
    }

    /**
    * The event's broadcast name.
    *
    * @return string
    */
    /*public function broadcastAs()
    {
       
    }*/

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-message-channel');
    }

    /* public function broadcastWith()
    {
        return ['id' => 'prueba'];
    }*/
}
