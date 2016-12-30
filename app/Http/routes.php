<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::group(array('prefix' => 'web'), function () {
    # shop web home page
    Route::get('/', 'shopWeb\ShopWebController@index');

    # customer register and login and logout
    Route::get('/register', 'ShopWeb\RegisterController@index');
    Route::post('/register', 'ShopWeb\RegisterController@register');
    Route::get('/login', 'ShopWeb\LoginController@index');
    Route::post('/login', 'ShopWeb\LoginController@login');
    Route::get('/logout', 'ShopWeb\LoginController@logout');

    # shop
    Route::post('/shop', 'ShopWeb\ShopWebController@buy');
});

Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

Route::get('install', 'InstallController@index');

Route::get('/', 'HomeController@index');

Route::group(array('prefix' => 'supplier'), function () {
    Route::get('list', "SupplierController@index");
    Route::get('add', "SupplierController@add");
    Route::post('add', "SupplierController@add_func");
    Route::get('edit/{id}', "SupplierController@edit");
    Route::post('edit', "SupplierController@edit_func");
});

Route::group(array('prefix' => 'customer'), function () {
    Route::get('list', "CustomerController@index");
    Route::get('list/{id}', "CustomerController@detail");
});

Route::group(array('prefix' => 'product'), function () {
    Route::get('list', "ProductController@index");
    Route::get('add', "ProductController@add");
    Route::post('add', "ProductController@add_func");
    Route::get('edit/{id}', "ProductController@edit");
    Route::post('edit', "ProductController@edit_func");
});

Route::get('corder/list', "CusOrderController@index");
Route::get('sorder/list', "SupOrderController@index");

Route::group(array('prefix' => 'account'), function () {
    Route::get('list', "AccountController@index");
    Route::get('add', "AccountController@add");
    Route::post('add', "AccountController@add_func");
    Route::get('edit', "AccountController@edit");
    Route::post('edit', "AccountController@edit_func");
    Route::post('state', "AccountController@state");
    Route::get('check', "AccountController@check");
});

Route::group(array('prefix' => 'chart'), function () {
    Route::get('sale', "HomeController@home_sale");
});
