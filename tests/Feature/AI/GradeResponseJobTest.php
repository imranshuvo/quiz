<?php

use App\Jobs\GradeResponse;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\Response;
use App\Models\ResponseAnswer;
use App\Models\Workspace;
use App\Services\Tenancy;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Testing\StructuredResponseFake;
use Prism\Prism\ValueObjects\Usage;

beforeEach(function () {
    $this->workspace = Workspace::factory()->create();
    app(Tenancy::class)->setCurrent($this->workspace);
});

it('GradeResponse job re-establishes tenancy and grades the response', function () {
    Prism::fake([
        StructuredResponseFake::make()
            ->withStructured(['score' => 1.0, 'feedback' => 'Good'])
            ->withUsage(new Usage(50, 25)),
    ]);

    $q = Questionnaire::factory()->create(['workspace_id' => $this->workspace->id]);
    $textQ = Question::factory()->shortText()->forQuestionnaire($q)->create(['meta' => ['max_points' => 2]]);
    $r = Response::factory()->forQuestionnaire($q)->submitted()->create(['score' => 0, 'max_score' => 0]);
    ResponseAnswer::factory()->pair($r, $textQ)->create(['value' => ['my answer']]);

    // Simulate the worker context — tenancy starts unset.
    app(Tenancy::class)->setCurrent(null);

    // Direct invocation, mirroring queue worker handle().
    (new GradeResponse($r->id, $this->workspace->id))
        ->handle(app(\App\Services\AI\Grader::class), app(Tenancy::class));

    expect((float) $r->fresh()->answers->first()->score)->toBe(1.0);
});

it('GradeResponse job drops gracefully when the workspace is gone', function () {
    $missingWorkspaceId = 9_999_999;

    // Should not throw.
    (new GradeResponse(responseId: 1, workspaceId: $missingWorkspaceId))
        ->handle(app(\App\Services\AI\Grader::class), app(Tenancy::class));

    expect(true)->toBeTrue();
});
