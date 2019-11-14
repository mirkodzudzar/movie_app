<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
       if(Auth::check())
       {
         if(Auth::user()->isNotAdmin())
         {
             return $next($request);
         }

         return redirect('/news');
       }
     }
}
