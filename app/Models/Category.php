<?php

namespace App\Models;

use App\Tenant\Observers\TenantObserver;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['tenant_id','name', 'url', 'description'];


    // public function scopeTenantCategory(Builder $query)
    // {
    //     return $query->where('tenant_id', auth()->user()->tenant_id);
    // }
    //---> nao há mais necessidade, estou usando um scope global onde traz esse mesmo resultado

    public function search($filter)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")->get();

    return $results;
    }

    /**
     * belongsToMany Categorias tem muitos Produtos
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    //public function
}
