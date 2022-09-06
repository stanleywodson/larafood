<?php

namespace App\Respositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductsByTenantId(int $idTenant, array $categories);

    public function getProductByTitle(string $title, string $uuid);

}
