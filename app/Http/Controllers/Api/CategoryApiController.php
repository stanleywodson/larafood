<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\TenantService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    //retorna todos as  categorias de um tenant
    public function categoriesByTenant(Request $request)
    {
        return $this->categoryService->getCategoriesByTenantUuid($request->uuid);
    }
}
