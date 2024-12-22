<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GatePassRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $gatePassId;
    public $userName;

    public function __construct($gatePass, $userName)
    {
        $this->gatePassId = $gatePass->id;
        $this->userName = $userName;
    }

    public function broadcastOn()
    {
        return new Channel('superadmin-channel');
    }
}
