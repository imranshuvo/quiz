<?php

namespace App\Http\Controllers\Api;

use App\Services\Billing\Limits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkspaceController extends ApiController
{
    public function show(Request $request, Limits $limits): JsonResponse
    {
        $workspace = $this->workspace($request);

        return response()->json(['data' => [
            'id' => $workspace->id,
            'name' => $workspace->name,
            'slug' => $workspace->slug,
            'role' => $request->user()->roleIn($workspace)?->value,
            'plan' => $limits->planFor($workspace)->value,
            'usage' => $limits->summary($workspace),
        ]]);
    }
}
