<?php

namespace App\Providers;

use App\Services\TodolistService;
use Illuminate\Support\ServiceProvider;
use App\Services\Impl\TodolistServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;

class TodolistServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        TodolistService::class => TodolistServiceImpl::class
    ];

    public function provides()
    {
        return [TodolistService::class];
    }

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
        //
    }
}
