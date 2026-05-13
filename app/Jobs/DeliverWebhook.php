<?php

namespace App\Jobs;

use App\Models\Response;
use App\Models\WebhookDelivery;
use App\Models\WebhookEndpoint;
use App\Models\Workspace;
use App\Services\Tenancy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Throwable;

class DeliverWebhook implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 5;

    public int $backoff = 60;

    public function __construct(
        public int $endpointId,
        public int $responseId,
        public int $workspaceId,
    ) {
    }

    public function handle(Tenancy $tenancy): void
    {
        $workspace = Workspace::find($this->workspaceId);
        if (! $workspace) {
            return;
        }
        $tenancy->setCurrent($workspace);

        $endpoint = WebhookEndpoint::find($this->endpointId);
        $response = Response::with(['questionnaire', 'answers.question'])->find($this->responseId);

        if (! $endpoint || ! $endpoint->active || ! $response) {
            return;
        }

        $delivery = WebhookDelivery::create([
            'workspace_id' => $this->workspaceId,
            'webhook_endpoint_id' => $endpoint->id,
            'response_id' => $response->id,
            'status' => 'pending',
        ]);

        $payload = $this->buildPayload($response);
        $body = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $signature = 'sha256='.hash_hmac('sha256', $body, $endpoint->secret);

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'User-Agent' => 'QuizSaaS-Webhook/1.0',
                'X-Signature-256' => $signature,
                'X-Event' => 'response.submitted',
                'X-Delivery' => (string) $delivery->id,
            ])
                ->timeout(10)
                ->withBody($body, 'application/json')
                ->post($endpoint->url);

            $delivery->forceFill([
                'status' => $http->successful() ? 'success' : 'failed',
                'attempts' => $delivery->attempts + 1,
                'http_status' => $http->status(),
                'last_error' => $http->successful() ? null : substr((string) $http->body(), 0, 500),
                'delivered_at' => $http->successful() ? now() : null,
            ])->save();

            if ($http->successful()) {
                $endpoint->forceFill(['last_delivered_at' => now()])->save();
            } else {
                $this->release($this->backoff);
            }
        } catch (Throwable $e) {
            $delivery->forceFill([
                'status' => 'failed',
                'attempts' => $delivery->attempts + 1,
                'last_error' => substr($e->getMessage(), 0, 500),
            ])->save();

            throw $e; // Let Laravel's retry handle it.
        }
    }

    protected function buildPayload(Response $response): array
    {
        return [
            'event' => 'response.submitted',
            'questionnaire' => [
                'id' => $response->questionnaire->id,
                'kind' => $response->questionnaire->kind->value,
                'title' => $response->questionnaire->title,
                'slug' => $response->questionnaire->slug,
            ],
            'response' => [
                'id' => $response->id,
                'submitted_at' => optional($response->submitted_at)->toIso8601String(),
                'score' => $response->score !== null ? (float) $response->score : null,
                'max_score' => $response->max_score !== null ? (float) $response->max_score : null,
                'respondent_email' => $response->respondent_email,
                'respondent_user_id' => $response->respondent_user_id,
                'answers' => $response->answers->map(fn ($a) => [
                    'question_id' => $a->question_id,
                    'question_title' => $a->question->title ?? '',
                    'value' => $a->value,
                    'is_correct' => $a->is_correct,
                    'score' => $a->score !== null ? (float) $a->score : null,
                ])->all(),
            ],
        ];
    }
}
