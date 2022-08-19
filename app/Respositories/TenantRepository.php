<?php

namespace App\Respositories;

use App\Models\Tenant;
use App\Respositories\Contracts\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    private $entity;

    public function __construct(Tenant $tenant)
    {

        $this->entity = $tenant;
    }

    public function getAllTenants($per_page)
    {
        return $this->entity->paginate($per_page);
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first();
    }

}
