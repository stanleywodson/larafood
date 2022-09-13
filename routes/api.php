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
 * Tenants
 */
Route::get('/tenant/{uuid}', [TenantApiController::class, 'show']);
Route::get('/tenants', [TenantApiController::class, 'index']);
/**
 * Categories
 */
Route::get('/category/{url}', [CategoryApiController::class, 'getCategoryByUrl']);
Route::get('/categories/', [CategoryApiController::class, 'categoriesByTenant']);
/**
 * Tables
 */
Route::get('/table/{identity}', [TableApiController::class, 'show']);
Route::get('/tables/', [TableApiController::class, 'getTablesByTenantUuid']);
/**
 * Products
 */
Route::get('/product/{title}', [ProductApiController::class, 'show']);
Route::get('/products/', [ProductApiController::class, 'getProductsByTenantId']);
/**
 * Client
 */
Route::get('/client/{id}',[\App\Http\Controllers\Api\Auth\RegisterController::class, 'getClient']);
Route::post('/client',[\App\Http\Controllers\Api\Auth\RegisterController::class, 'store']);

