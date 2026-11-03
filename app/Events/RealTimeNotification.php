<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RealTimeNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $video_title;

    public $video_id;

    public $date;

    /**
     * Create a new event instance.
     */
    public function __construct($data = [])
    {
        $this->video_id = $data['video_id'];
        $this->video_title = $data['video_title'];
        $this->date = Carbon::now()->diffForHumans();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            'real-time-notifications',
        ];
    }

    public function broadcastAs()
    {
        return 'real-time-notification-event';
    }
}
