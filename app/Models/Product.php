<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use TenantTrait; //Produtos vão ser separados por Tenants(empresas)

    protected $fillable = ['title', 'flag','image', 'price', 'description'];

    public function search($filter)
    {
        $results = $this->where('title', 'LIKE', "%{$filter}%")->get();

        return $results;
    }

    /**
     * belongsToMany Produtos pertence a varias Categorias N:N
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function categoriesAvailable()
    {
        $categories = Category::whereNotIn('categories.id', function($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })->get();

        return $categories;
    }
}
