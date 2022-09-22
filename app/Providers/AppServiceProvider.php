<?php

namespace App\Providers;

use App\Respositories\Contracts\TenantRepositoryInterface;
use App\Respositories\TenantRepository;
use App\Models\{Category, Client, Plan, Product, Table, Tenant};
use App\Observers\{CategoryObserver, ClientObserver, PlanObserver, ProductObserver, TableObserver, TenantObserver};
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
        Table::observe(TableObserver::class);
        Client::observe(ClientObserver::class);
    }
}
