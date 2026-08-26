<?php

namespace App\Events;

use App\Models\Questionnaire;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Fired whenever a vote is recorded against a live poll. The PublicPoll
 * Livewire component listens on `polls.{slug}` and refreshes its tally
 * counts so audiences see the bars move in real time.
 */
class PollVoteRecorded implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public Questionnaire $questionnaire,
        public int $questionId,
    ) {}

    public function broadcastOn(): Channel
    {
        return new Channel('polls.'.$this->questionnaire->slug);
    }

    public function broadcastAs(): string
    {
        return 'vote-recorded';
    }

    public function broadcastWith(): array
    {
        return [
            'question_id' => $this->questionId,
        ];
    }
}
