<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckForHostelManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd('CheckForHostelManager middleware is working');
        if (!Auth::check() || !Auth::user()->hasRole('hostel_manager')) {
            abort(403, 'Unauthorized action.');
        }
        

        return $next($request);
    }
}
