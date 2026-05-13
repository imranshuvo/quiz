<?php

namespace App\Listeners;

use App\Events\ResponseSubmitted;
use App\Jobs\DeliverWebhook;
use App\Models\WebhookEndpoint;

class DispatchWebhooks
{
    public function handle(ResponseSubmitted $event): void
    {
        $response = $event->response;

        $endpoints = WebhookEndpoint::query()
            ->forQuestionnaire($response->questionnaire_id)
            ->get();

        foreach ($endpoints as $endpoint) {
            DeliverWebhook::dispatch($endpoint->id, $response->id, $response->workspace_id);
        }
    }
}
