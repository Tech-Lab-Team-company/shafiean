<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class CheckWebsiteLinkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $websiteLink = $request->header("website-link");

        if ($websiteLink == null) {
            throw new \Exception("Website Link is required in Header", 400);
        }
        $organization = Organization::whereWebsiteLink($websiteLink)->first();

        if ($organization) {
            // return $organization->id;
            
            return $next($request);
        }

        throw new \Exception("website link is invaild", 400);

    }
}
