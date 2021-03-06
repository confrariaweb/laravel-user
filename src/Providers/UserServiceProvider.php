<?php

namespace ConfrariaWeb\User\Providers;

use App\Models\User;
use ConfrariaWeb\User\Commands\CheckPackage;
use ConfrariaWeb\User\Contracts\UserContract;
use ConfrariaWeb\User\Observers\UserObserver;
use ConfrariaWeb\User\Repositories\UserRepository;
use ConfrariaWeb\User\Services\UserService;
use ConfrariaWeb\Vendor\Traits\ProviderTrait;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{

    use ProviderTrait;

    public function register()
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind('UserService', function ($app) {
            return new UserService($app->make(UserContract::class));
        });
    }

    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                CheckPackage::class
            ]);
        }

        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../Views', 'user');
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../Translations', 'user');
        $this->publishes([__DIR__ . '/../../config/cw_user.php' => config_path('cw_user.php')], 'config');
        $this->publishes([__DIR__ . '/../../public/' => public_path('vendor/laravel-user/')], 'public');
        //$this->registerSeedsFrom(__DIR__.'/../../databases/Seeds');

        User::observe(UserObserver::class);
    }

}
