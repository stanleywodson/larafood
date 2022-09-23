<?php

namespace App\Services;

use App\Respositories\Contracts\TableRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;

class TableService
{
    protected $tableRepository, $tenantRepository;

    public function __construct(TableRepositoryInterface $tableRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        $tenant =  $this->tenantRepository->getTenantByUuid($uuid);
        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }

    public function getTableByUuid(string $identity)
    {
        return $this->tableRepository->getTableByUuid($identity);
    }

}
