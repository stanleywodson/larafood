<?php
use App\Http\Controllers\Admin\ACL\{PermissionProfileController,
                              ProfileController,
                              PermissionController,
                              PlanProfileController,
};
use App\Http\Controllers\Admin\{CategoryController,
    CategoryProductController,
    PlanController,
    PlanDetailController,
    TableController,
    UserController};
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;
/**
 * Route Site
 */
    Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
    Route::get('/', [SiteController::class, 'index'])->name('site.home');


Route::prefix('admin')->middleware('auth')->group(function(){
    /**
     * Route Tables
     */
    Route::any('/tables/search', [TableController::class, 'search'])->name('tables.search');
    Route::resource('/tables', TableController::class);
    /**
     *Route Products
     */

    Route::any('/products/search', [\App\Http\Controllers\Admin\ProductController::class, 'search'])->name('products.search');
    Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class);
    /**
 *  * Route Category
 */

   Route::any('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
   Route::resource('/categories', CategoryController::class);
/**
 * Route Users
 */

    Route::any('/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('/users', UserController::class);
    /**
     * Categories x Products
     */
    Route::get('/categories/{idCategory}/products/{idProduct}/detach', [CategoryProductController::class, 'detachProductCategory'])->name('categories.products.detach');
    //Route::post('/categories/{id}/', [CategoryProductController::class, 'attachPermissionProfile'])->name('categories.products.attach'); //nao vai ter essa rota
    //Route::get('/categories/{id}/create', [CategoryProductController::class, 'permissionsAvailable'])->name('categories.products.available'); //nao vai ter essa rota
    Route::get('/products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories'); // rota ok
    //Profiles x Plan
    Route::get('/categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products'); // rota ok
/**
 * Plan x Profile
 */
    Route::controller(PlanProfileController::class)->group(function (){

        Route::get('/plans/{id}/profile/{idProfile}/detach','detachPermissionProfile')->name('plans.profiles.detach');
        Route::post('/plans/{id}/', 'attachPermissionProfile')->name('plans.profiles.attach');
        Route::get('/plans/{id}/create',  'permissionsAvailable')->name('plans.profiles.available');
        Route::get('/plans/{id}/profiles',  'profiles')->name('plans.profiles');
        //Profiles x Plan
        Route::get('/profiles/{id}/plans', 'plans')->name('profiles.plans');
    });

/**
 * Profile x Permission
 */
    Route::get('/profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permissions.detach');
    Route::post('/profiles/{id}/', [PermissionProfileController::class, 'attachPermissionProfile'])->name('profiles.permissions.attach');
    Route::get('/profiles/{id}/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('/profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    //Permission x Profile
    Route::get('/permissions/{id}/profiles', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');

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
 * Route Details Plan
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
/**
 * Route Auth
 */
    Auth::routes();

