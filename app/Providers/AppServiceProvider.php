<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
// Custom directive for checking if user is a student
Blade::directive('student', function () {
    return "<?php if(auth()->check() && auth()->user()->hasRole('student')): ?>";
});

Blade::directive('endstudent', function () {
    return "<?php endif; ?>";
});

// Custom directive for checking if user is a hostel_manager
Blade::directive('hostel_manager', function () {
    return "<?php if(auth()->check() && auth()->user()->hasRole('hostel_manager')): ?>";
});

Blade::directive('endhostel_manager', function () {
    return "<?php endif; ?>";
});

// Custom directive for checking if user is a super_admin
Blade::directive('super_admin', function () {
    return "<?php if(auth()->check() && auth()->user()->hasRole('super_admin')): ?>";
});

Blade::directive('endsuper_admin', function () {
    return "<?php endif; ?>";
});

// Custom directive for checking if user is an admin
Blade::directive('admin', function () {
    return "<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>";
});

Blade::directive('endadmin', function () {
    return "<?php endif; ?>";
});    }
}
