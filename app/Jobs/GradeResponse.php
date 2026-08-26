<?php

namespace App\Jobs;

use App\Models\Response;
use App\Models\Workspace;
use App\Services\AI\Grader;
use App\Services\Tenancy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GradeResponse implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public int $backoff = 30; // seconds

    public function __construct(public int $responseId, public int $workspaceId) {}

    public function handle(Grader $grader, Tenancy $tenancy): void
    {
        // Re-establish tenancy in the queue worker context — without it the
        // global scope would hide the response.
        $workspace = Workspace::find($this->workspaceId);
        if (! $workspace) {
            Log::warning('GradeResponse: workspace gone, dropping job', [
                'workspace_id' => $this->workspaceId,
                'response_id' => $this->responseId,
            ]);

            return;
        }

        $tenancy->setCurrent($workspace);

        $response = Response::with('questionnaire')->find($this->responseId);
        if (! $response) {
            return; // Response deleted before grading ran.
        }

        $grader->gradeResponse($response);
    }
}
