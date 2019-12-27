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

// unprotected routes
Route::get('/', function () {
    return view('welcome');
});

// authentication routes
Auth::routes();

// generic routes
Route::group(['middleware' => ['role:admin|instructor|student']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
});

// admin routes
Route::group(['middleware' => ['role:admin']], function(){
    Route::get('/admin','AdminController@index')->name('index');
});
