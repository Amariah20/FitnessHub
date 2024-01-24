<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//this was written with the assistance of AI. It was producing an error where the checks were not performing properly. AI helped me fix it. My original code was missing the !auth()->check(). 

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
