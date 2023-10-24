<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GlobalAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //only global admin can access requested page
        if(auth()->user()?->email != 'globaladmin@gmail.com'){     
            abort(Response::HTTP_FORBIDDEN);
        }
        return $next($request);
        return $next($request);
    }
}
