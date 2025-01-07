<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Leave;

class NewLeaveRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $leave;

    public function __construct(Leave $leave)
    {
        $this->leave = [
            'id' => $leave->id,
            'employee_name' => $leave->employee->first_name . ' ' . $leave->employee->last_name,
            'date_from' => $leave->date_from,
            'date_to' => $leave->date_to,
            'type' => $leave->type->name,
            'status' => $leave->status,
            'created_at' => $leave->created_at->diffForHumans()
        ];
    }

    public function broadcastOn()
    {
        return ['leave-requests'];
    }

    public function broadcastAs()
    {
        return 'new-leave-request';
    }
}