<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //if user is not authenticated or is_admin in user table is false, dont allow user to access the requested page
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
