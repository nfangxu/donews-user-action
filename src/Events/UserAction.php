<?php
/**
 * Created by PhpStorm.
 * User: nfangxu
 * Date: 2018/10/9
 * Time: 17:45
 */

namespace Fangxu\UserAction\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class UserAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $topic;

    /**
     * Create a new event instance.
     **
     ** who? when? where? what? how?
     **
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $data["userActionTime"] = now("PRC");
        $this->data = json_encode($data);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}