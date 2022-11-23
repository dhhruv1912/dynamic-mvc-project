<?php

use Illuminate\Support\Facades\Route;



Route::any('/', 'HomeController@index')->name('home');
//new route//

// Login
Route::any('/Admin/', 'Admin\AdminController@index')->name('admin.login');
Route::any('/Admin/register', 'Admin\AdminController@register')->name('admin.reg');
Route::any('/Admin/register-admin/{id?}', 'Admin\AdminController@register_admin')->name('admin.save');
Route::any('/Admin/admin-login', 'Admin\AdminController@admin_login')->name('admin.login_');

// Admin 
Route::group(['prefix' => 'Admin','middleware' => ['web','auth:admin']], function () {
    
    Route::any('/login-out', 'Admin\AdminController@admin_logout')->name('admin.logout');
    Route::any('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::any('/menu', 'Admin\MenuController@index')->name('admin.menu');
    Route::any('/menu/add/{id?}', 'Admin\MenuController@add_menu')->name('admin.add_menu');
    Route::any('/menu/view/{id}', 'Admin\MenuController@view_menu')->name('admin.menu.view');
    Route::any('/menu/delete/{id}', 'Admin\MenuController@delete_menu')->name('admin.menu.delete');
    Route::any('/menu/save/{id?}', 'Admin\MenuController@save_menu')->name('admin.save_menu');

    Route::any('/product', 'Admin\ProductController@index')->name('admin.product');
    Route::any('/product/form/{id?}', 'Admin\ProductController@load_form')->name('admin.product_add');
    Route::post('/product/save/{id?}', 'Admin\ProductController@save_form')->name('admin.product_save');
    Route::any('/product/delete/{id}', 'Admin\ProductController@delete_product')->name('admin.product_delete');

    Route::any('/setting', 'Admin\SettingController@index')->name('admin.setting');
    Route::any('/setting/save', 'Admin\SettingController@save')->name('admin.setting.save');
    //new Admin route//

});
