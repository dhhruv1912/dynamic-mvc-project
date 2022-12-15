<?php

use Illuminate\Support\Facades\Route;



Route::any('/', 'HomeController@index')->name('home');

Route::any('/login', 'LogController@login_form')->name('login_form');
Route::any('/logout', 'LogController@logout')->name('logout');
Route::any('/login-user', 'LogController@login')->name('login');
Route::any('/rerister', 'LogController@reg_form')->name('reg_form');
Route::any('/rerister-user', 'LogController@reg')->name('reg');

Route::any('/shop', 'ShopController@index')->name('front.shop');
Route::post('/shop/filter', 'ShopController@filter')->name('front.filter');
Route::any('/category', 'ShopController@category_listing')->name('front.category_listing');
Route::any('/category/{category}', 'ShopController@category')->name('front.category');
Route::any('/tag/{tag}', 'ShopController@tag')->name('front.tag');
Route::any('/product/{product}', 'ShopController@product')->name('front.product');

Route::any('/about', 'HomeController@about_page')->name('front.about');

Route::any('/cart', 'HomeController@cart_page')->name('front.cart');
Route::any('/cart/add', 'UserController@add_to_cart')->name('front.cart.add');
Route::any('/cart/remove/{product}', 'UserController@remove_from_cart')->name('front.cart.remove');
Route::any('/cart/update', 'UserController@update_cart')->name('cart_update');

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
    Route::any('/setting/add', 'Admin\SettingController@add_setting')->name('admin.add_setting');
    Route::any('/setting/save/{id}', 'Admin\SettingController@save')->name('admin.setting.save');
    
    Route::any('/category', 'Admin\CategoryController@index')->name('admin.category');
    Route::any('/category/form/{id?}', 'Admin\CategoryController@load_form')->name('admin.category.form');
    Route::any('/category/save/{id?}', 'Admin\CategoryController@save_form')->name('admin.category.save');
    Route::any('/category/delete/{id}', 'Admin\CategoryController@delete')->name('admin.category.delete');
//new Admin route//


});
