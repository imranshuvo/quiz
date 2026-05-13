<?php

namespace App\Events;

use App\Models\Response;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Fired the moment Taker::submit finalizes a Response. Listeners decide
 * what to do with it (queue webhooks, kick off insights re-analysis, etc.).
 */
class ResponseSubmitted
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Response $response)
    {
    }
}
