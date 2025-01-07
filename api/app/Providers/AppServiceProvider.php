<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\Services\AuthenticationServiceInterface;
use Src\Infrastructure\Repositories\PasswordResetTokenEloquentRepository;
use Src\Infrastructure\Repositories\UserEloquentRepository;
use Src\InterfaceAdapters\Services\SanctumAuthenticationAdapter;
use Src\InterfaceAdapters\Services\SmtpEmailService;

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

        $this->app->singleton(
            PasswordResetTokenRepositoryInterface::class,
            PasswordResetTokenEloquentRepository::class
        );
    }

    private function registerServices(): void
    {
        $this->app->singleton(
            AuthenticationServiceInterface::class,
            SanctumAuthenticationAdapter::class
        );

        $this->app->singleton(
            EmailServiceInterface::class,
            SmtpEmailService::class
        );
    }
}
