<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//tạo route login vào trang admin
Route::get('/admin', 'AdminLogin@login');
Route::post('/admin', 'AdminLogin@postlogin');
Route::get('/home',function (){
    return view('home');
});

//các route chức năng
Route::prefix('admin')->group(function (){

    // category route
    Route::prefix('categories')->group(function () {

        Route::get('/', [
            'as' =>'categories.index',
            'uses' => 'CategoryController@index'
        ]);

        Route::get('/create', [
            'as' =>'categories.create',
            'uses' => 'CategoryController@create'
        ]);

        Route::post('/store', [
            'as' =>'categories.store',
            'uses' => 'CategoryController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' =>'categories.edit',
            'uses' => 'CategoryController@edit'
        ]);

        Route::get('/delete/{id}', [
            'as' =>'categories.delete',
            'uses' => 'CategoryController@delete'
        ]);

        Route::post('/update/{id}', [
            'as' =>'categories.update',
            'uses' => 'CategoryController@update'
        ]);
    });

    //menu route
    Route::prefix('menus')->group(function () {

        Route::get('/', [
            'as' =>'menus.index',
            'uses' => 'MenuController@index'
        ]);

        Route::get('/create', [
            'as' =>'menus.create',
            'uses' => 'MenuController@create'
        ]);

        Route::post('/store', [
            'as' =>'menus.store',
            'uses' => 'MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' =>'menus.edit',
            'uses' => 'MenuController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' =>'menus.update',
            'uses' => 'MenuController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' =>'menus.delete',
            'uses' => 'MenuController@delete'
        ]);
    });

    //Product router
    Route::prefix('product')->group(function () {

        Route::get('/', [
            'as' =>'products.index',
            'uses' => 'ProductController@index'
        ]);

        Route::get('/create', [
            'as' =>'products.create',
            'uses' => 'ProductController@create'
        ]);

        Route::post('/store', [
            'as' =>'products.store',
            'uses' => 'ProductController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' =>'products.edit',
            'uses' => 'ProductController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' =>'products.update',
            'uses' => 'ProductController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' =>'products.delete',
            'uses' => 'ProductController@delete'
        ]);

    });

    //Slider router
    Route::prefix('slider')->group(function () {

        Route::get('/', [
            'as' =>'slider.index',
            'uses' => 'SliderController@index'
        ]);

        Route::get('/create', [
            'as' =>'slider.create',
            'uses' => 'SliderController@create'
        ]);

        Route::post('/store', [
            'as' =>'slider.store',
            'uses' => 'SliderController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' =>'slider.edit',
            'uses' => 'SliderController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' =>'slider.update',
            'uses' => 'SliderController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' =>'slider.delete',
            'uses' => 'SliderController@delete'
        ]);

    });

    //Setting router
    Route::prefix('setting')->group(function () {

        Route::get('/', [
            'as' =>'setting.index',
            'uses' => 'SettingController@index'
        ]);

        Route::get('/create', [
            'as' =>'setting.create',
            'uses' => 'SettingController@create'
        ]);

        Route::post('/store', [
            'as' =>'setting.store',
            'uses' => 'SettingController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' =>'setting.edit',
            'uses' => 'SettingController@edit'
        ]);

        Route::post('/update/{id}', [
            'as' =>'setting.update',
            'uses' => 'SettingController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' =>'setting.delete',
            'uses' => 'SettingController@delete'
        ]);

    });

    //Cart Route
    Route::prefix('cart')->group(function () {

        Route::get('/', [
            'as' =>'cart.index',
            'uses' => 'CartController@index'
        ]);

        Route::get('/cart_detail/{id}', [
            'as' =>'cart.cart_detail',
            'uses' => 'CartController@cartDetail'
        ]);

        Route::get('/delete/{id}', [
            'as' =>'cart.delete',
            'uses' => 'CartController@delete'
        ]);

    });

});

