<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('role:admin')->group(function () {
    Route::get('roles/permission', 'RoleController@permission')->name('roles.permission');
    Route::post('roles/permission/update', 'RoleController@permissionUpdate')->name('roles.permission.update');
    Route::resource('roles', 'RoleController')->except([
        'show'
    ]);


    Route::resource('users', 'UserController');
});
