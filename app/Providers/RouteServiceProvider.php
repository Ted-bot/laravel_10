<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware(['web','auth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/web/admin/admin.php'));

            Route::middleware(['web','auth'])
                ->prefix('admin/users')
                ->namespace($this->namespace)
                ->group(base_path('routes/web/user/user.php'));

            Route::middleware(['web','auth'])
                ->prefix('admin/posts')
                ->namespace($this->namespace)
                ->group(base_path('routes/web/posts/posts.php'));

            Route::middleware(['web','auth','role:admin'])
                ->prefix('admin/roles')
                ->namespace($this->namespace)
                ->group(base_path('routes/web/roles/roles.php'));

            Route::middleware(['web','auth','role:admin'])
                ->prefix('admin/permissions')
                ->namespace($this->namespace)
                ->group(base_path('routes/web/permissions/permissions.php'));
        });


    }
}
