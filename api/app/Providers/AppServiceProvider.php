<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\Services\AuthenticationServiceInterface;
use Src\Infrastructure\Repositories\UserEloquentRepository;
use Src\InterfaceAdapters\Services\SanctumAuthenticationAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );

        $this->app->singleton(
            AuthenticationServiceInterface::class,
            SanctumAuthenticationAdapter::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
