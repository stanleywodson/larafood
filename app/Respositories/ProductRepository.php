<?php

namespace App\Respositories;

use App\Respositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductsByTenantId(int $idTenant, array $categories)
    {
        return DB::table($this->table)
              ->join('category_product', 'category_product.product_id', '=', 'products.id')
              ->join('categories', 'category_product.category_id', '=', 'categories.id')
              ->where('products.tenant_id', $idTenant)
              ->where('categories.tenant_id', $idTenant)
              ->where(function ($query) use ($categories){
                    if ($categories != []){
                    $query->whereIn('categories.url', $categories);
                    }
              })
              ->get();
    }

    /**
     * @param string $title
     * @param string $uuid
     * @return Model|Builder|object|null
     */
    public function getProductByTitle(string $title, string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'products.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->where('products.title', $title)
            ->first();
    }
}
