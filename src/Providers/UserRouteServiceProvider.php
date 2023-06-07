<?php

namespace ConfrariaWeb\User\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class UserRouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {

        $this->routes(function () {
            Route::middleware(['api'])
                ->prefix('api')
                ->name('api.')
                ->group(__DIR__ . '/../Routes/api.php');

            Route::middleware('web')
                ->group(__DIR__ . '/../Routes/web.php');
        });
    }

}
