<?php

namespace App\Respositories;

use App\Respositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';
    }
//    public function getTablesByTenantUuid(string $uuid)
//    {
//        return DB::table($this->table)
//            ->select('tables.*')
//            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
//            ->where('tenants.uuid', $uuid)
//            ->get();
//    }

    public function getTablesByTenantId(int $idTenant)
    {
        return DB::table($this->table)->where('tenant_id', $idTenant)->get();

    }

    public function getTableByIdentity(string $identity, string $uuid)
    {
        return DB::table($this->table)
            ->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->where('tables.identity', $identity)
            ->where('tenants.uuid', $uuid)
            ->first();
    }

}