<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\TableApiController;
use App\Http\Controllers\Api\TenantApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
/**
 * Order(pedidos)
 */
Route::get('/order/{identify}', [\App\Http\Controllers\Api\OrderApiController::class, 'show']);
Route::post('/orders', [\App\Http\Controllers\Api\OrderApiController::class, 'store']);
/**
 * Tenants
 */
Route::get('/tenant/{uuid}', [TenantApiController::class, 'show']);
Route::get('/tenants', [TenantApiController::class, 'index']);
/**
 * Categories
 */
Route::get('/category/{identity}', [CategoryApiController::class, 'show']);
Route::get('/categories/', [CategoryApiController::class, 'categoriesByTenant']);
/**
 * Tables
 */
Route::get('/table/{identity}', [TableApiController::class, 'show']);
Route::get('/tables/', [TableApiController::class, 'getTablesByTenantUuid']);
/**
 * Products
 */
Route::get('/product/{identify}', [ProductApiController::class, 'show']);
Route::get('/products/', [ProductApiController::class, 'getProductsByTenantId']);
/**
 * Client
 */
Route::get('/client/{id}',[\App\Http\Controllers\Api\Auth\RegisterController::class, 'getClient']);
Route::post('/client',[\App\Http\Controllers\Api\Auth\RegisterController::class, 'store']);
/**
 * Sactum Client
 */
Route::post('/sactum/token', [\App\Http\Controllers\Api\Auth\ClientController::class, 'auth']);


Route::group([
    'middleware' => ['auth:sanctum']
], function(){
Route::get('/auth/me',[\App\Http\Controllers\Api\Auth\ClientController::class, 'me']);
Route::post('/auth/logout',[\App\Http\Controllers\Api\Auth\ClientController::class, 'logout']);
});

