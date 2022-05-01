<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TryJobEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $number;
    public string $transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($number, $transaction)
    {
        $this->number = $number;
        $this->transaction = $transaction;
    }
}
