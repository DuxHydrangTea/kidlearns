<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Blade::directive('role', function ($expression) {
            return "<?php if(auth()->user() && auth()->user()->role == $expression): ?>";
        });

        // Directive đóng
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
