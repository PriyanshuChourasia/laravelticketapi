<?php

namespace App\Providers;

use App\Services\Interfaces\ITaskService;
use App\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //Your code here 

        $this->app->bind(TaskService::class, ITaskService::class);
    }
}
