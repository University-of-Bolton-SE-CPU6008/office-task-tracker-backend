<?php

namespace App\Providers;

use App\Repositories\Designation\DesignationRepository;
use App\Repositories\Designation\Interface\DesignationRepositoryInterface;
use App\Repositories\Employer\EmployerRepository;
use App\Repositories\Employer\Interface\EmployerRepositoryInterface;
use App\Repositories\Project\Interface\ProductRepositoryInterface;
use App\Repositories\Project\ProductRepository;
use App\Repositories\Task\Interface\TaskRepositoryInterface;
use App\Repositories\Task\Interface\TaskTypeRepositoryInterface;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskTypeRepository;
use App\Repositories\User\Interface\UserLevelRepositoryInterface;
use App\Repositories\User\Interface\UserRepositoryInterface;
use App\Repositories\User\UserLevelRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserLevelRepositoryInterface::class, UserLevelRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(TaskTypeRepositoryInterface::class, TaskTypeRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(DesignationRepositoryInterface::class, DesignationRepository::class);
        $this->app->bind(EmployerRepositoryInterface::class, EmployerRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
