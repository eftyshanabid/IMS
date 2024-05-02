<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\app\Http\Controllers\AttributeController;
use Modules\Products\app\Http\Controllers\AttributeOptionController;
use Modules\Products\app\Http\Controllers\CategoryController;
use Modules\Products\app\Http\Controllers\ProductGroupController;
use Modules\Products\app\Http\Controllers\ProductsController;

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
    Route::resource('attributes', AttributeController::class)
        ->middleware('permission:attributes|attribute-create|attribute-edit|attribute-delete');

    Route::resource('attribute-options', AttributeOptionController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('categories/{id}/create-attributes', [CategoryController::class, 'createAttributes']);
    Route::post('categories/{id}/update-attributes', [CategoryController::class, 'updateAttributes']);

    Route::resource('product-groups', ProductGroupController::class);
    Route::resource('products', ProductsController::class)->names('products');
});