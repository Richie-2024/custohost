<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Render a custom 401 error page for unauthenticated users
            return response()->view('errors.401', [], 401);
        }


        // Check if the authenticated user has the "innovator" role
        $user = Auth::user();
        if (!$user->hasRole('student')) {
            // Render a custom 403 error page for unauthorized access
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
