<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $modules = [
            'Product',
            'Order',
        ];

        foreach ($modules as $module) {
            $this->app->bind(
                "App\Repositories\\{$module}\\{$module}RepositoryInterface",
                "App\Repositories\\{$module}\\{$module}Repository"
            );
        }
    }

    public function boot(): void {}
}