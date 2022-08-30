<?php

namespace App\Services;

use App\Respositories\CategoryRepository;
use App\Respositories\Contracts\CategoryRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;

class CategoryService
{
    protected $tenantRepository, $categoryRepository;

 public function __construct(TenantRepositoryInterface $tenantRepository, CategoryRepositoryInterface $categoryRepository)
 {
      $this->categoryRepository = $categoryRepository;
      $this->tenantRepository = $tenantRepository;
 }

    public function getCategoriesByTenantUuid(string $uuid)
    {
//        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
//        return $this->categoryRepository->getCategoriesByTenantId($tenant->id);
        return $this->categoryRepository->getCategoriesByTenantUuid($uuid);
    }

    public function getCategoryByUrl(string $url)
    {
        return $this->categoryRepository->getCategoryByUrl($url);
    }

}
