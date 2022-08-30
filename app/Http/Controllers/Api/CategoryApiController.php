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

    //retorna todos as  categorias de um tenant
    public function categoriesByTenant(TenantFormRequest $request)
    {
//        if (!$request->token_company)
//            return response()->json(['message' => 'Token not found'], 404);


        $categories =  $this->categoryService->getCategoriesByTenantUuid($request->token_company);
        return CategoryResource::collection($categories);
    }

    public function getCategoryByUrl(TenantFormRequest $request, $url)
    {
        if (!$category = $this->categoryService->getCategoryByUrl($url))
            return response()->json(['message' => 'Category not found'], 404);

        return new CategoryResource($category);
    }
}
