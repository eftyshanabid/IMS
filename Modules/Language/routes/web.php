<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\app\Http\Controllers\LanguageController;
use Modules\Language\app\Http\Controllers\LanguageLibraryController;

Route::prefix('admin')->middleware(['auth','admin.auth'])->group(function () {
    Route::resource('languages', LanguageController::class);
    Route::resource('language-library', LanguageLibraryController::class);
});
