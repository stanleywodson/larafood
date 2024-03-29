<?php

namespace App\Respositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantId(int $idTenant, array $categories);

    public function getProductByUuid(string $identify);

}
