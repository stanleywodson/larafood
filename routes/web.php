<?php
use App\Http\Controllers\Admin\ACL\{
                              PermissionProfileController,
                              ProfileController,
                              PermissionController,
                              PlanProfileController,
                              PermissionCargoController,
                              CargoUserController
};
use App\Http\Controllers\Admin\
    {CategoryController,
    CategoryProductController,
    PlanController,
    PlanDetailController,
    TableController,
    TenantController,
    UserController};

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;
//use App\Models\Traits\UserACLTrait;
/**
 * Route Site
 */
    Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
    Route::get('/', [SiteController::class, 'index'])->name('site.home');

Route::get('teste', function (){
    $client = \App\Models\Client::find(9);
    $token = $client->createToken('token-teste');
    dd($token->plainTextToken);
});

Route::prefix('admin')->middleware('auth')->group(function(){
    /**
     * Route Tenant(Empresa)
     */
    Route::get('/tenants/{id}',[TenantController::class, 'update'])->name('tenant.update');
    Route::get('/tenants/{id}/edit',[TenantController::class, 'edit'])->name('tenant.edit');
    Route::get('/tenants',[TenantController::class, 'index'])->name('tenant.index');
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
     * Route Cargos
     */
    //Route::get('/cargos/pdf', [\App\Http\Controllers\Admin\ACL\CargoController::class, 'pdf'])->name('cargos.pdf');
    Route::any('/cargos/search', [\App\Http\Controllers\Admin\ACL\CargoController::class, 'search'])->name('cargos.search');
    Route::resource('/cargos', \App\Http\Controllers\Admin\ACL\CargoController::class);
    /**
     * Route Users x Cargos
     */
    Route::get('/users/{userId}/cargos/{cargoId}/detach', [CargoUserController::class, 'dettachUserCargo'])->name('users.cargos.detach');
    Route::post('/users/{id}/', [CargoUserController::class, 'attachUserCargo'])->name('users.cargos.attach');
    Route::get('/users/{id}/create', [CargoUserController::class, 'cargosAttach'])->name('users.cargos.available');
    Route::get('/users/{id}/cargos', [CargoUserController::class, 'cargos'])->name('users.cargos');
    //users x Users
    Route::get('/cargos/{id}/users', [CargoUserController::class, 'users'])->name('cargos.users');
    Route::post('cargo-test/{id}', [CargoUserController::class, 'getAllCargosOfUser'])->name('cargo-test');
    /**
     * Route Cargos x Permissions
     */
    Route::get('/cargos/{id}/permission/{idPermission}/detach', [PermissionCargoController::class, 'detachPermissionProfile'])->name('cargos.permissions.detach');
    Route::post('/cargos/{id}/', [PermissionCargoController::class, 'attachPermissionProfile'])->name('cargos.permissions.attach');
    Route::get('/cargos/{id}/create', [PermissionCargoController::class, 'permissionsAvailable'])->name('cargos.permissions.available');
    Route::get('/cargos/{id}/permissions', [PermissionCargoController::class, 'permissions'])->name('cargos.permissions');
    //Permission x Cargo
    Route::get('/permissions/{id}/cargos', [PermissionCargoController::class, 'cargos'])->name('permissions.cargos');
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

