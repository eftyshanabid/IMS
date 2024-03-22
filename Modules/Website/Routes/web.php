<?php

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

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth','admin.auth'])->group(function() {

    Route::resource('sliders','SliderController');
    //->middleware('permission:sliders|slider-create|slider-edit|slider-delete','slider-update');

    Route::resource('pages','PagesController');
    //->middleware('permission:pages-list|pages-create|pages-edit|pages-delete');

    Route::resource('faqs','FaqsController');
    //->middleware('permission:faqs|faq-create|faq-edit|faq-delete|faq-update');

    Route::resource('contact-us-message','ContactUsController');

    Route::get('website-settings','WebsiteController@websiteIndex');
    Route::post('website-settings-store','WebsiteController@websiteStore')->name('website.settings.store');

    Route::get('social-media-settings','WebsiteController@socialMediaIndex');
    Route::post('social-media-store','WebsiteController@socialStore')->name('social.settings.store');

    Route::get('wallet-connect','WebsiteController@walletaIndex');
    Route::post('wallet-store','WebsiteController@walletStore')->name('wallet.settings.store');

    Route::get('mail-credential','WebsiteController@mailIndex');
    Route::post('mail-store','WebsiteController@mailStore')->name('mail.settings.store');

});

