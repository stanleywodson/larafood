<?php

namespace App\Providers;

use App\Respositories\CategoryRepository;
use App\Respositories\Contracts\CategoryRepositoryInterface;
use App\Respositories\Contracts\TableRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;
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
