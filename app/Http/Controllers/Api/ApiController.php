<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    protected function workspace(Request $request): Workspace
    {
        return $request->attributes->get('workspace');
    }

    protected function authorizeContentWrite(Request $request): void
    {
        $workspace = $this->workspace($request);
        abort_unless($request->user()->roleIn($workspace)?->canEditContent(), 403);
    }
}
