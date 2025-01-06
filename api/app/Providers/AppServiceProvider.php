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
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerRepositories(): void
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );
    }

    private function registerServices(): void
    {
        $this->app->singleton(
            AuthenticationServiceInterface::class,
            SanctumAuthenticationAdapter::class
        );
    }
}
