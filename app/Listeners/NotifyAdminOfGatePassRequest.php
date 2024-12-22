<?php

namespace App\Listeners;

use App\Events\GatePassRequested;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GatePassApprovalNotification;

class NotifyAdminOfGatePassRequest
{
    public function handle(GatePassRequested $event)
    {
        
        $admin = User::role('superadmin')->first();     
        Notification::send($admin, new GatePassApprovalNotification($event->user, $event->gatePassDetails));
    }
}
