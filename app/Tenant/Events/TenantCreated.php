<?php

namespace App\Tenant\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TenantCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
       $this->user = $user;
    }

    /**
     * @return User
     * return user created
     */
    public function user(): User
    {
        return $this->user;
    }

    /**
     * @return mixed
     * get tenant
     */
    public function tenant()
    {
        return $this->user->tenant;
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
