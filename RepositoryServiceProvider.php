<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\EloquentUserRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\EloquentCategoryRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\EloquentProductRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\EloquentOrderRepository;
use App\Services\UserServiceInterface;
use App\Services\UserService;
use App\Services\CategoryServiceInterface;
use App\Services\CategoryService;
use App\Services\ProductServiceInterface;
use App\Services\ProductService;
use App\Services\OrderServiceInterface;
use App\Services\OrderService;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    public function boot()
    {
        
    }
}
