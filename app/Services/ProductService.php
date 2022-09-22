<?php

namespace App\Services;

use App\Respositories\Contracts\ProductRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;

class ProductService
{
    protected $tenantInterface, $productInterface;

    public function __construct(TenantRepositoryInterface $tenantInterface, ProductRepositoryInterface $productInterface)
    {
        $this->productInterface = $productInterface;
        $this->tenantInterface = $tenantInterface;
    }

    public function getProductsByTenantId(string $uuid, array $categories)
    {
        $tenant = $this->tenantInterface->getTenantByUuid($uuid);
        return $this->productInterface->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductByUuid(string $identify)
    {
        return $this->productInterface->getProductByUuid($identify);
    }

}
