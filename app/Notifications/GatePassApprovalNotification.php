<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GatePassApprovalNotification extends Notification
{
    use Queueable;

    public $user;
    public $gatePassDetails;

    public function __construct($user, $gatePassDetails)
    {
        $this->user = $user;
        $this->gatePassDetails = $gatePassDetails;
    }

    public function via($notifiable)
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'title' => 'Gate Pass Approval Request',
            'message' => "{$this->user->name} has requested a gate pass approval.",
            'action_url' => route('requestgp', ['id' => $this->gatePassDetails->id]),
            'approve_url' => route('approvedgp', ['id' => $this->gatePassDetails->id]),
            'reject_url' => route('rejectedgp', ['id' => $this->gatePassDetails->id]),
        ];
    }
}
