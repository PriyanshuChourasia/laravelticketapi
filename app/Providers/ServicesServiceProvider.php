<?php

namespace App\Providers;

use App\Services\Interfaces\IItemGroupService;
use App\Services\Interfaces\IItemService;
use App\Services\Interfaces\IItemUnitService;
use App\Services\Interfaces\ITaskService;
use App\Services\Interfaces\IUserService;
use App\Services\ItemGroupService;
use App\Services\ItemService;
use App\Services\ItemUnitService;
use App\Services\TaskService;
use App\Services\UserService;
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

        $this->app->bind(IItemService::class, ItemService::class);

        $this->app->bind(IItemUnitService::class, ItemUnitService::class);

        $this->app->bind(IUserService::class, UserService::class);

        $this->app->bind(IItemGroupService::class, ItemGroupService::class);
    }
}
