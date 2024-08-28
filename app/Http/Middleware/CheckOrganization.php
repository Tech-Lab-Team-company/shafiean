<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Organization;

class CheckOrganization
{

    public function handle(Request $request, Closure $next)
    {
        $webKey = $request->header('web_key');
        if (!$webKey) {
            return response()->json(['error' => 'web_key is required'], 400);
        }
        $organization = Organization::where('web_key', $webKey)->first();

        if (!$organization) {
            return response()->json(['error' => 'Invalid web_key'], 401);
        }
        $request->attributes->set('organization', $organization);

        return $next($request);
    }
}
