<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Repositories\{EmailUpdateTokenRepositoryInterface,
    PasswordResetTokenRepositoryInterface,
    UserRepositoryInterface};
use Src\Domain\Services\AuthenticationServiceInterface;
use Src\Infrastructure\Repositories\{EmailUpdateTokenEloquentRepository,
    PasswordResetTokenEloquentRepository,
    UserEloquentRepository};
use Src\InterfaceAdapters\Services\{SanctumAuthenticationAdapter, SmtpEmailService};

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

        $this->app->singleton(
            EmailUpdateTokenRepositoryInterface::class,
            EmailUpdateTokenEloquentRepository::class
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
