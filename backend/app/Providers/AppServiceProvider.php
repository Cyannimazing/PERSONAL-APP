<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Repositories\ApplicationRepositoryInterface;
use App\Interfaces\Repositories\UserApplicationRepositoryInterface;
use App\Interfaces\Services\AuthServiceInterface;
use App\Interfaces\Services\ApplicationServiceInterface;
use App\Interfaces\Services\UserApplicationServiceInterface;
use App\Repositories\UserRepository;
use App\Repositories\ApplicationRepository;
use App\Repositories\UserApplicationRepository;
use App\Services\AuthService;
use App\Services\ApplicationService;
use App\Services\UserApplicationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ApplicationRepositoryInterface::class, ApplicationRepository::class);
        $this->app->bind(UserApplicationRepositoryInterface::class, UserApplicationRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ApplicationServiceInterface::class, ApplicationService::class);
        $this->app->bind(UserApplicationServiceInterface::class, UserApplicationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
