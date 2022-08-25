<?php

namespace App\Respositories;

use App\Respositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return DB::table($this->table)
            ->select('categories.*')
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->get();


//        return DB::table($this->table)
//            ->join('tenants', function($join) {
//                $join->on('tenants.id', '=', 'categories.tenant_id')
//                    ->where('tenants.uuid', $uuid)
//            ->select('categories.*');
//            })
//            ->get();

        // TODO: Implement getCategoriesByTenantUuid() method.
    }

    // trará todas as categorias onde o tenant id for igual ao que for enviado.
    public function getCategoriesByTenantId(int $idTenant)
    {
        return DB::table($this->table)->where('tenant_id', $idTenant)->get();

        // TODO: Implement getCategoriesByTenantId() method.
    }

}

