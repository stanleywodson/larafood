<?php

use App\Http\Controllers\Api\CategoryApiController;
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
Route::get('/categories/', [CategoryApiController::class, 'categoriesByTenant']);

