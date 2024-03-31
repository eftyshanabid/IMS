<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;

Route::get('reboot', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    //file_put_contents(storage_path('logs/laravel.log'),'');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    //Artisan::call('schedule:run');

    return '<center><h1>System Rebooted!</h1></center>';
});

Route::get('/', function(){
    return redirect('dashboard');
});

Route::get('dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin.auth'])->name('dashboard');

Route::get('/404', function () {
    return view('no-page');
});

Route::get('/update-language/{code}', function ($code) {
    $language = \Modules\Language\app\Models\Language::where('code', $code)->first();
    if(isset($language->code)){
        session()->put('language', $language->code);
    }
   return redirect()->back();
});

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';


Route::get('square-payment-form', [\App\Http\Controllers\SquareController::class, 'index'])->name('square.index');
Route::post('pay-with-square', [\App\Http\Controllers\SquareController::class, 'payWithSquare'])->name('pay-with-square');
Route::get('square-callback', [\App\Http\Controllers\SquareController::class, 'callback'])->name('square-callback');


//Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
//Route::post('pay-checkout', [CheckoutController::class, 'paymentStore'])->name('checkout.store');
//Route::get('checkout-callback', [CheckoutController::class, 'callback'])->name('checkout.callback');
