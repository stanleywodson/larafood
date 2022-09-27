<?php

namespace App\Respositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantUuid(string $uuid);

    public function getCategoriesByTenantId(int $id);

    public function getCategoryByUuid(string $identify);
}
