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

Route::get('admin','LoginController@showLoginForm')->name('admin.login');
Route::post('admin','LoginController@login');
Route::post('admin/logout','LoginController@logout')->name('admin.logout');
Route::post('admin/password/email','ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin/password/reset','ResetPasswordController@reset')->name('admin.password.update');
Route::get('admin/password/reset/{token}','ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard','AdminController@index')->name('dashboard');
    Route::get('profile', 'AdminController@show')->name('profile');
    Route::put('password/update', 'AdminController@passwordUpdate')->name('password.update');
    Route::put('email/update', 'AdminController@emailUpdate')->name('email.update');
    Route::put('profile/update', 'AdminController@profileUpdate')->name('profile.update');
    Route::resource('resellers', 'ResellerController');
});
