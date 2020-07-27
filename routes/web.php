<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();


Route::group(['middleware' => 'locale'], function () {
    Route::get('/', 'Shop\HomeController@index');
    Route::get('/home', 'Shop\HomeController@index')->name('home');

    Route::get('/change-password/{id}', 'Shop\InfoController@ChangePasswordById')->name('change.password.id');
    Route::post('/change-password/{id}','Shop\InfoController@doChangePasswordById')->name('change.password.id.do');

    Route::group(['prefix' => 'product'], function (){
        Route::get('/list','Shop\ProductController@index')->name('shop.product.list');
        Route::get('/detail/{id}','Shop\ProductController@detail')->name('shop.product.detail');
    });

    Route::group(['prefix' => 'cart'], function (){
        Route::get('/','Shop\CartController@index')->name('cart.list');
        Route::post('/add','Shop\CartController@doAdd')->name("cart.add.do");
        Route::post('/remove','Shop\CartController@doRemove')->name('cart.remove.do');
        Route::post('/add-quantity','Shop\CartController@addQuantity')->name('cart.add.quantity');
        Route::post('/remove-quantity','Shop\CartController@removeQuantity')->name('cart.remove.quantity');
    });

    Route::get("/".config("app.route_admin"), function (){
        return redirect()->route('dashboard');
    });

    Route::group(['prefix' => "/".config("app.route_admin")], function () {
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

        Route::group(["prefix" => "category"], function (){
            Route::get("/", "Admin\CategoryController@index")->name("category.list");
            Route::get("/add", "Admin\CategoryController@add")->name("category.add");
            Route::post("/add", "Admin\CategoryController@doAdd")->name("category.add.do");
            Route::get("/edit/{id}", "Admin\CategoryController@edit")->name("category.edit");
            Route::post("/edit/{id}", "Admin\CategoryController@doEdit")->name("category.edit.do");
            Route::post("/delete", "Admin\CategoryController@doDelete")->name("category.delete.do");
        });

        Route::group(["prefix" => "product"], function (){
            Route::get("/", "Admin\ProductController@index")->name("product.list");
            Route::get("/add", "Admin\ProductController@add")->name("product.add");
            Route::post("/add", "Admin\ProductController@doAdd")->name("product.add.do");
            Route::get("/edit/{id}", "Admin\ProductController@edit")->name("product.edit");
            Route::post("/edit/{id}", "Admin\ProductController@doEdit")->name("product.edit.do");
            Route::post("/delete", "Admin\ProductController@doDelete")->name("product.delete.do");
        });


        Route::group(["prefix" => "customer"], function (){
            Route::get("/", "Admin\CustomerController@index")->name("customer.list");
            Route::get("/add", "Admin\CustomerController@add")->name("customer.add");
            Route::post("/add", "Admin\CustomerController@doAdd")->name("customer.add.do");
            Route::get("/edit/{id}", "Admin\CustomerController@edit")->name("customer.edit");
            Route::post("/edit/{id}", "Admin\CustomerController@doEdit")->name("customer.edit.do");
            Route::post("/delete", "Admin\CustomerController@doDelete")->name("customer.delete.do");
            Route::post("/reset", "Admin\CustomerController@doReset")->name("customer.reset.do");
            Route::post("/lock", "Admin\CustomerController@doLock")->name("customer.lock.do");
            Route::post("/unlock", "Admin\CustomerController@doUnlock")->name("customer.unlock.do");
        });

        Route::group(["prefix" => "member"], function (){
            Route::get("/", "Admin\MemberController@index")->name("member.list");
            Route::get("/add", "Admin\MemberController@add")->name("member.add");
            Route::post("/add", "Admin\MemberController@doAdd")->name("member.add.do");
            Route::get("/edit/{id}", "Admin\MemberController@edit")->name("member.edit");
            Route::post("/edit/{id}", "Admin\MemberController@doEdit")->name("member.edit.do");
            Route::post("/delete", "Admin\MemberController@doDelete")->name("member.delete.do");
            Route::post("/reset", "Admin\MemberController@doReset")->name("member.reset.do");
            Route::post("/lock", "Admin\MemberController@doLock")->name("member.lock.do");
            Route::post("/unlock", "Admin\MemberController@doUnlock")->name("member.unlock.do");
        });

        Route::group(['prefix' => 'common'], function (){
            Route::post('/remove-image','Admin\CommonController@doRemoveImage')->name('common.remove.image');
            Route::post('/delete-image','Admin\CommonController@doDeleteImage')->name('common.delete.image');
            Route::post('/upload-image','Admin\CommonController@doAddImage')->name('common.upload.image');
        });

        Route::group(["prefix" => "setting"], function (){
            Route::get("/profile", "Admin\SettingController@profile")->name("setting.profile");
            Route::post("/profile/{id}", "Admin\SettingController@doProfile")->name("setting.profile.do");
            Route::get("/change-password","Admin\SettingController@changePassword")->name("setting.changePassword");
            Route::post("/change-password/{id}","Admin\SettingController@doChangePassword")->name("setting.changePassword.do");
        });

        Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
        Route::post('/logout', 'Auth\AdminLoginController@logout');
        Route::get('/login', 'Auth\AdminLoginController@getLogin')->name('admin.show');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    });
});
