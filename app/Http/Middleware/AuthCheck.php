<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //to check wheater user is logged in or not to fetch user details
        if(!session()->has('user') && ($request->path() !='/login' && $request->path() !='/register' ))
        {
            return redirect('login');
        }
        // to check if user is already looged in then user should not try to reaccess login or register page
        if(session()->has('user') && ($request->path() =='login' || $request->path() =='register' ))
        {
            return back();
        }

        return $next($request);
    }
}
