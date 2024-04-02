<?php

use Illuminate\Support\Facades\Route;
use Modules\IMS\app\Http\Controllers\ChargesController;
use Modules\IMS\app\Http\Controllers\CustomerController;
use Modules\IMS\app\Http\Controllers\DepartmentController;
use Modules\IMS\app\Http\Controllers\DesignationController;
use Modules\IMS\app\Http\Controllers\IMSController;
use Modules\IMS\app\Http\Controllers\SupplierController;
use Modules\IMS\app\Http\Controllers\UnitsController;
use Modules\IMS\app\Http\Controllers\WarehouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->middleware(['auth', 'admin.auth'])->group(function () {
    Route::resource('ims', IMSController::class)->names('ims');

    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('units', UnitsController::class);
    Route::resource('charges', ChargesController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('customers', CustomerController::class);
});
