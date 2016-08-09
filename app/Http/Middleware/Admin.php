<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	 
	// lekcija: 27 - Application - 212.Security  part 1 - middleware registration.mp4
    public function handle($request, Closure $next){
      return $next($request);
	  
    }
}






















