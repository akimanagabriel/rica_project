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
        Blade::directive('currentPath', function () {
            $path = str_replace("/", " > ", request()->path());
            $path = str_replace("_", " ", $path);
            $path = ucwords($path);
            return "<?php echo $path; ?>";
        });
    }
}
