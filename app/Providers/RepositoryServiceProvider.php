<?php

namespace App\Providers;

use App\Respositories\CategoryRepository;
use App\Respositories\ClientRepository;
use App\Respositories\Contracts\CategoryRepositoryInterface;
use App\Respositories\Contracts\ClientRepositoryInterface;
use App\Respositories\Contracts\EvaluationRepositoryInterface;
use App\Respositories\Contracts\OrderRepositoryInterface;
use App\Respositories\Contracts\ProductRepositoryInterface;
use App\Respositories\Contracts\TableRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;
use App\Respositories\EvaluationRepository;
use App\Respositories\OrderRepository;
use App\Respositories\ProductRepository;
use App\Respositories\TableRepository;
use App\Respositories\TenantRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(

            TenantRepositoryInterface::class,
            TenantRepository::class

        );

        $this->app->bind(

            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(

            TableRepositoryInterface::class,
            TableRepository::class
        );

        $this->app->bind(

            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(

            ClientRepositoryInterface::class,
            ClientRepository::class
        );

        $this->app->bind(

            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(

            EvaluationRepositoryInterface::class,
            EvaluationRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
