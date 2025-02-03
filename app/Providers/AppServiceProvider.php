<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;


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
        // Register the middleware
    Route::aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
    Route::aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
    Route::aliasMiddleware('role_or_permission', \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class);
    }
}
