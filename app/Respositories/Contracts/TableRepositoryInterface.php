<?php

namespace App\Respositories\Contracts;

interface TableRepositoryInterface
{
    //public function getTablesByTenantUuid(string $uuid);

    public function getTablesByTenantId(int $idTenant);

    public function getTableByIdentity(string $identity, string $uuid);
}
