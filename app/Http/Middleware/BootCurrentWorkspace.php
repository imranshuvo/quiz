<?php

namespace App\Http\Middleware;

use App\Services\Tenancy;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BootCurrentWorkspace
{
    public function __construct(protected Tenancy $tenancy) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            $workspace = $this->tenancy->resolveFor($user);
            $this->tenancy->setCurrent($workspace);
        }

        return $next($request);
    }
}
