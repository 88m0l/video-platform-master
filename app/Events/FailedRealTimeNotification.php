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

class FailedRealTimeNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $date;


    public $video_title;

    /**
     * Create a new event instance.
     */
    public function __construct($data = [])
    {
        echo "Event is running";
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
            'failed-real-time-notification'
        ];
    }

    public function broadcastAs() 
    {
        return 'fail-real-time-notification-event';
    }
}
