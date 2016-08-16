<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
	
	  // lekcija: 27 - Application - 213.Security part 2 - middleware - custom method and 404 page.mp4
	  if(Auth::check()){ // proveri da li je user ulogovan
	    if(Auth::user()->isAdmin()){ // proveri da li je admin koristeci isAdmin() metod User.php modela
		  return $next($request); // ako jeste prosledi request dalje
		}
	  }
	  return redirect('/'); // ako nije administrator posalji ga na pocetnu  stranu
    }
	
	
}






















