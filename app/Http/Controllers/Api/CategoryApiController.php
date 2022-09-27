<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Services\TenantService;
use http\Env\Response;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function show(TenantFormRequest $request, $identify)
    {
        if (!$category = $this->categoryService->getCategoryByUuid($identify))
            return response()->json(['message' => 'Category not found'], 404);

        return new CategoryResource($category);
    }

    //retorna todos as  categorias de um tenant
    public function categoriesByTenant(TenantFormRequest $request)
    {
        $categories =  $this->categoryService->getCategoriesByTenantUuid($request->token_company);
        return CategoryResource::collection($categories);
    }

}
