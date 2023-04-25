<?php

namespace App\Http\Middleware;

use Closure;




class Admin{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle($request, Closure $next)
    { 
        if(auth()->user()->isAdmin() || auth()->user()->isStaff()){
            return $next($request);
            
        }
        return redirect('/');
    }
}
