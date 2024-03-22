<?php

use Illuminate\Support\Facades\Route;
use Modules\CMS\app\Http\Controllers\CMSController;
use Modules\CMS\app\Http\Controllers\DocumentTypesController;
use Modules\CMS\app\Http\Controllers\ServicesController;
use Modules\CMS\app\Http\Controllers\SalespersonController;

Route::prefix('admin')->middleware(['auth','admin.auth'])->group(function () {
    Route::resource('services', ServicesController::class);
    
});
