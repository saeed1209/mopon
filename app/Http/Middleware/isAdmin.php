<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!auth()->guard($guard)->check())
            return redirect('login');
        if(auth()->guard($guard)->user()->role == 'user' )
            abort(403, 'User does not have admin access');
        return $next($request);
    }
}
