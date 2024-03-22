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

Route::prefix('admin')->middleware(['auth','admin.auth'])->group(function () {

    Route::get('/my-account', 'AdminController@myAccount')->name('my.account');
    Route::put('/my-account/update/{id}', 'AdminController@update')->name('my.account.update');
    Route::post('update-user-column-visibilities', 'AdminController@updateUserColumnVisibilities');


    Route::get('/notifications', 'DashboardController@notification')->name('admin.notification');
    Route::get('/notification/read/{id}', 'DashboardController@notificationRead')
        ->name('notification.read');

    Route::put('notification/read/{id}/update', 'DashboardController@update')
        ->name('notification.read.update');

    Route::group(['prefix' => 'acl', 'as' => 'acl.'], function () {

        Route::resource('roles', 'Spatie\RoleController');
        // ->middleware('permission:role-list|role-create|role-edit|role-delete');

        Route::get('/roles-data', 'Spatie\RoleController@rolesData');

        Route::resource('permission', 'Spatie\AclPermissionController');
        //->middleware('permission:permission-list|permission-create|permission-edit|permission-delete');

        Route::get('/approval', 'Spatie\AclPermissionController@approvalSettings')->name('approval-settings');

        Route::resource('menu', 'Menu\MenuController');
        /*->middleware('permission:menu-list|menu-create|menu-edit|menu-delete');*/

        Route::resource('sub-menu', 'Menu\SubMenuController');
        /*->middleware('permission:sub-menu-list|sub-menu-create|sub-menu-edit|sub-menu-delete');*/

        Route::resource('users', 'UserController');
        // ->middleware('permission:user-list|user-create|user-edit|user-delete');

        Route::get('deleted-users', 'UserController@deleted')
            ->name('users.deleted');
        // ->middleware('permission:user-list|user-create|user-edit|user-delete');

        Route::get('restore-user/{id}', 'UserController@restore');
        // ->middleware('permission:user-list|user-create|user-edit|user-delete');

        Route::get('/users-data', 'UserController@usersDataLoad');
        Route::get('check-user/{id}', 'UserController@checkUser');
    });
});
