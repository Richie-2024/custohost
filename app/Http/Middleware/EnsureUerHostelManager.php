<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsHostelManager
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'hostel_manager') {
            abort(403, 'Only hostel managers can access this page.');
        }

        return $next($request);
    }
}
