<?php

namespace App\Http\Middleware;

use App\Models\Workspace;
use App\Services\Tenancy;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveApiWorkspace
{
    public function __construct(protected Tenancy $tenancy) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        abort_unless($user, 401);

        $requested = trim((string) $request->header('X-Workspace'));

        $workspace = $requested !== ''
            ? Workspace::query()
                ->where(fn ($query) => $query->where('slug', $requested)
                    ->when(ctype_digit($requested), fn ($query) => $query->orWhereKey((int) $requested)))
                ->whereHas('memberships', fn ($query) => $query->where('user_id', $user->id))
                ->first()
            : $this->tenancy->resolveFor($user);

        abort_unless($workspace, 404, 'No accessible workspace was found.');

        $this->tenancy->setCurrent($workspace);
        $request->attributes->set('workspace', $workspace);

        return $next($request);
    }
}
