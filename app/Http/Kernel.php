<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        // ... other middleware aliases
        'hostel_manager' => \App\Http\Middleware\EnsureUserIsHostelManager::class,

        'student' => \App\Http\Middleware\EnsureUserIsStudent::class,
    ];
}