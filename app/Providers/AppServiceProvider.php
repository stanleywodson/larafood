<?php

namespace App\Providers;

use App\Respositories\Contracts\TenantRepositoryInterface;
use App\Respositories\TenantRepository;
use App\Models\{Category, Plan, Product, Tenant};
use App\Observers\{CategoryObserver, PlanObserver, ProductObserver, TenantObserver};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(

            TenantRepositoryInterface::class,
            TenantRepository::class

        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
