<?php

use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo '<h1>Stanley Wodson Carneiro de Souza</h1>';
});
Route::any('admin/plan/search', [PlanController::class, 'search'])->name('plans.search');
Route::delete('admin/plan/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
Route::get('admin/plan/{url}', [PlanController::class, 'show'])->name('plans.show');
Route::post('admin/plans', [PlanController::class, 'store'])->name('plans.store');
Route::get('admin/plans/create', [PlanController::class, 'create'])->name('plans.create');
Route::get('admin/plans', [PlanController::class, 'index'])->name('plans.index');
