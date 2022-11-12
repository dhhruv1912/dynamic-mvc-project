<?php
use Illuminate\Support\Facades\Route;



Route::any('/', 'HomeController@index')->name('home');
//new route//

// Admin 
Route::group(['prefix'=>'Admin'],function(){
    Route::any('/','Admin\DashboardController@index')->name('admin.dashboard');
    Route::any('/menu','Admin\MenuController@index')->name('admin.menu');
    Route::any('/menu/add/{id?}','Admin\MenuController@add_menu')->name('admin.add_menu');
    Route::any('/menu/view/{id}','Admin\MenuController@view_menu')->name('admin.menu.view');
    Route::any('/menu/delete/{id}','Admin\MenuController@delete_menu')->name('admin.menu.delete');
    Route::any('/menu/save/{id?}','Admin\MenuController@save_menu')->name('admin.save_menu');
    // admin.product-start 
Route::any('/product', 'ProductController@index')->name('admin.product');
// admin.product-end 
//new Admin route//




});
