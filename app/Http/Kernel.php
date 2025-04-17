<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        // ... other middleware aliases
        'student' => \App\Http\Middleware\EnsureUserIsStudent::class,
        'hostel_manager' => \App\Http\Middleware\EnsureUserIsHostelManager::class,
    ];
}