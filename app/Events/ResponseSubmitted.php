<?php

namespace App\Events;

use App\Models\Response;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Fired the moment Taker::submit finalizes a Response. Listeners decide
 * what to do with it (queue webhooks, kick off insights re-analysis, etc.).
 */
class ResponseSubmitted implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public bool $afterCommit = true;

    public function __construct(public Response $response) {}

    public function broadcastOn(): Channel
    {
        return new Channel('leaderboards.'.$this->response->questionnaire->slug);
    }

    public function broadcastAs(): string
    {
        return 'response-submitted';
    }

    public function broadcastWith(): array
    {
        return ['response_id' => $this->response->id];
    }
}
