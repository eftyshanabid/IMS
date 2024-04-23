<?php

use Illuminate\Support\Facades\Route;
use Modules\Commercial\app\Http\Controllers\CommercialController;

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

Route::group([], function () {
    Route::resource('commercial', CommercialController::class)->names('commercial');
});
