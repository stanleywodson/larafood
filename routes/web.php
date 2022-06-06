<?php
use App\Http\Controllers\ACL\{PermissionProfileController, 
                              ProfileController, 
                              PermissionController, 
                              PlanController,
                              PlanDetailController};

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo '<h1>Stanley Wodson Carneiro de Souza</h1>';
});


/**
 * Route Detaiils
 */ 
    Route::prefix('admin')->group(function(){

    /**
 * Permission x Profile
 */
    Route::post('/profiles/{id}/', [PermissionProfileController::class, 'attachPermissionProfile'])->name('profiles.permissions.attach');
    Route::get('/profiles/{id}/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('/profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
/**
 * Route Permission
 */
    Route::resource('/permission', PermissionController::class);
/**
 * Route Profile
 */ 
    Route::any('/profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::resource('/profiles', ProfileController::class);
/**
 * Route Detaiils Plan
 */   
    Route::delete('/plans/{url}/detail/{idDetail}/destroy', [PlanDetailController::class, 'destroy'])->name('details.plans.destroy');
    Route::get('/plans/{url}/detail/create', [PlanDetailController::class, 'create'])->name('details.plans.create');
    Route::get('/plans/{url}/detail/{idDetail}', [PlanDetailController::class, 'show'])->name('details.plans.show');
    Route::put('/plans/{url}/detail/{idDetail}', [PlanDetailController::class, 'update'])->name('details.plans.update');
    Route::get('/plans/{url}/detail/{idDetail}/edit', [PlanDetailController::class, 'edit'])->name('details.plans.edit');
    Route::post('/plans/{url}/detail', [PlanDetailController::class, 'store'])->name('details.plans.store');
    
    Route::get('/plans/{url}/detail', [PlanDetailController::class, 'index'])->name('details.plans.index');

/**
 * Route plans
 */
    Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::put('/plans/{url}', [PlanController::class, 'update'])->name('plans.update');
    Route::get('/plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::any('/plan/search', [PlanController::class, 'search'])->name('plans.search');
    Route::delete('/plan/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::get('/plan/{url}', [PlanController::class, 'show'])->name('plans.show');
    Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');

/**
 * breadcrumb/dashboard
 */
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});