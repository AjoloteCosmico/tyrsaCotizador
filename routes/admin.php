<?php

use App\Http\Controllers\Admin\Administrador;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomerClassificationsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypesController;
use App\Http\Controllers\Admin\PrimeMaterialController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\SectorsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ZonesController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function()
{
    Route::resource('roles', RolController::class);
    Route::resource('zones', ZonesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('customer_classifications', CustomerClassificationsController::class);
    Route::resource('customer_types', CustomerTypesController::class);
    Route::resource('sectors', SectorsController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('prime_materials', PrimeMaterialController::class);
    Route::get('/administrador/', [Administrador::class, 'index'])->name('admin.index');
});

Route::group(['middleware' => ['auth:sanctum'], 'verified'], function()
{
    Route::get('ajax-autocomplete-search', [CustomerClassificationsController::class,'SelectCustomerClassifications']);
    Route::get('/contact/{customer_id}', [ContactController::class, 'principal'])->name('contactos.principal');
    Route::get('/newcontact/{customer_id}', [ContactController::class, 'new'])->name('contactos.nuevo');
    Route::get('prime_materials_showtables/', [PrimeMaterialController::class,'showtables'])->name('prime_materials.showtables');
    Route::put('prime_materials_tables/', [PrimeMaterialController::class,'tables_update'])->name('prime_materials.tables_update');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('ajax-autocomplete-search', [CustomerClassificationsController::class,'SelectCustomerClassifications']);
// Route::middleware(['auth:sanctum', 'verified'])->get('/contact/{customer_id}', [ContactController::class, 'principal'])->name('contactos.principal');
// Route::middleware(['auth:sanctum', 'verified'])->get('/newcontact/{customer_id}', [ContactController::class, 'new'])->name('contactos.nuevo');
// Route::middleware(['auth:sanctum', 'verified'])->get('prime_materials_showtables/', [PrimeMaterialController::class,'showtables'])->name('prime_materials.showtables');
// Route::middleware(['auth:sanctum', 'verified'])->put('prime_materials_tables/', [PrimeMaterialController::class,'tables_update'])->name('prime_materials.tables_update');