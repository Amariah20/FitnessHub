<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GlobalAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Session::put('previous_url', url()->previous());

        //only global admin can access requested page
        if(auth()->user()?->email != 'globaladmin@gmail.com'){     
            
           
            abort(Response::HTTP_FORBIDDEN);

            // Session::flash('Error!', 'You do not have access to this page. Please log in with the appropriate credentials');
           
       /*
           $redirect= url()->previous();
          //$redirect =Session::get('previous_url');
         
          if($redirect=='/locations'){
            return Redirect::to('/gymAll')->withErrors(['Error!', 'You do not have access to this page. Please log in with the appropriate credentials']);
           
        } else{
            return Redirect::to($redirect)->withErrors(['Error!', 'You do not have access to this page. Please log in with the appropriate credentials']);

        }*/
    }
       
            return $next($request);
        }
    }
