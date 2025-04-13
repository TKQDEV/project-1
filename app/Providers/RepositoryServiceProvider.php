<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\EloquentUserRepository;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Eloquent\EloquentCategoryRepository;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Eloquent\EloquentProductRepository;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Eloquent\EloquentOrderRepository;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\Implementations\UserService;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\Implementations\CategoryService;

use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Implementations\ProductService;

use App\Services\Interfaces\OrderServiceInterface;
use App\Services\Implementations\OrderService;

use App\Services\Interfaces\CartServiceInterface;
use App\Services\Implementations\CartService;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Repositories
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);


        
        

        // Services
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(CartServiceInterface::class,CartService::class);
    }

    public function boot()
    {
        
        
    }
}
