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


    public function scopeTenantCategory(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    public function search($filter)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
        ->tenantCategory()
        ->get();

    return $results;
    }
}
