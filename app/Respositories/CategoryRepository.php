<?php

namespace App\Respositories;

use App\Models\Category;
use App\Respositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $entity;

    public function __construct(Category $category)
    {
        return $this->entity = $category;
    }

    public function getCategoriesByTenantUuid(string $uuid)
    {
        return  $this->entity
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
            ->get();

        // TODO: Implement getCategoriesByTenantUuid() method.
    }

    public function getCategoriesByTenantId(int $id)
    {
        return  $this->entity
            ->where('tenant_id', $id)
            ->get();

    }
}
