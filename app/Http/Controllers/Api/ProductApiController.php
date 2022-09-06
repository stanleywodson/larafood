<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function getProductsByTenantId(TenantFormRequest $request)
    {
        $products = $this->productService->getProductsByTenantId($request->token_company, $request->get('categories', []));
        return ProductResource::collection($products);
    }

    public function show(string $title, TenantFormRequest $request)
    {
        if(!$product = $this->productService->getProductByTitle($title, $request->token_company)){

            return response()->json(['message' => 'title dont send!'], 404);
        }

        return new ProductResource($product);
    }
}
