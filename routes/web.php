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

//前台
#######################################################################################
Route::get('/', 'Index\IndexController@index');

Route::get('/login', 'Index\LoginController@login');

Route::post('/loginDo', 'Index\LoginController@loginDo');

Route::get('/reg', 'Index\RegController@reg');

Route::post('/reg', 'Index\RegController@regDo');

Route::get('/prolist', 'Index\ProductController@list');

Route::get('/proinfo/{id}', 'Index\ProductController@proinfo');

Route::post('/cart', 'Index\CartController@addCart');

Route::get('/cartlist', 'Index\CartController@cartList');

#######################################################################################
//外来人员统计
Route::get('/create', 'PeopleController@create');

Route::post('/store', 'PeopleController@store');

Route::get('/index', 'PeopleController@index');

Route::get('/edit/{id}', 'PeopleController@edit');

Route::post('/update/{id}', 'PeopleController@update');

Route::get('/destroy/{id}', 'PeopleController@destroy');

//学生统计
Route::prefix('student')->group(function (){

    Route::get('create', 'StudentController@create');

    Route::post('store', 'StudentController@store');

    Route::get('index', 'StudentController@index');

    Route::get('edit/{id}', 'StudentController@edit');

    Route::post('update/{id}', 'StudentController@update');

    Route::get('destroy/{id}', 'StudentController@destroy');
});

//品牌信息
Route::prefix('brand')->group(function (){

    Route::get('create', 'BrandController@create');

    Route::post('store', 'BrandController@store');

    Route::get('index', 'BrandController@index');

    Route::get('edit/{id}', 'BrandController@edit');

    Route::post('update/{id}', 'BrandController@update');

    Route::get('destroy/{id}', 'BrandController@destroy');
});

//分类信息
Route::prefix('cate')->group(function (){

    Route::get('create', 'CategoryController@create');

    Route::post('store', 'CategoryController@store');

    Route::get('index', 'CategoryController@index');

    Route::get('edit/{id}', 'CategoryController@edit');

    Route::post('update/{id}', 'CategoryController@update');

    Route::get('destroy/{id}', 'CategoryController@destroy');

    Route::get('checkOnly', 'CategoryController@checkOnly');
});

//商品信息
Route::prefix('goods')->group(function (){

    Route::get('create', 'GoodsController@create');

    Route::post('store', 'GoodsController@store');

    Route::get('index', 'GoodsController@index');

    Route::get('edit/{id}', 'GoodsController@edit');

    Route::post('update/{id}', 'GoodsController@update');

    Route::get('destroy/{id}', 'GoodsController@destroy');

    Route::post('checkOnly', 'GoodsController@checkOnly');
});

//管理员信息
Route::prefix('admin')->group(function (){

    Route::get('create', 'AdminController@create');

    Route::post('store', 'AdminController@store');

    Route::get('index', 'AdminController@index');

    Route::get('edit/{id}', 'AdminController@edit');

    Route::post('update/{id}', 'AdminController@update');

    Route::get('destroy/{id}', 'AdminController@destroy');

    Route::post('checkOnly', 'AdminController@checkOnly');
});

//文章
Route::prefix('article')->middleware('checkLogin')->group(function (){

    Route::get('create', 'ArticleController@create');

    Route::post('store', 'ArticleController@store');

    Route::get('index', 'ArticleController@index');

    Route::get('edit/{id}', 'ArticleController@edit');

    Route::post('update/{id}', 'ArticleController@update');

    Route::post('destroy/{id}', 'ArticleController@destroy');

    Route::post('checkOnly', 'ArticleController@checkOnly');

    Route::post('uniqueness', 'ArticleController@uniqueness');
});

//Route::view('/login', 'login.login');
//
//Route::post('/logindo', 'LoginController@logindo');

