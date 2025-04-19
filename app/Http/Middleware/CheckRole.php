<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {

        // // Check if the user is authenticated and has the given role
        // if (!Auth::check() || !Auth::user()->hasRole($role)) {
        //     // If not, redirect them back with an error
        //     return redirect()->route('login')->with('error', 'Access Denied');
        // }

        return $next($request);
    }
}
