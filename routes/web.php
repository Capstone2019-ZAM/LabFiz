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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UserController@show');

Route::get('/dashboard', function () {
    return view('dashboardPage');
});

Route::get('/templates', function () {
    return view('template_rpt');
});

Route::get('/template_builder', function () {
    return view('template_builder');
});


Route::get('/issueform', function () {
    return view('issue_rpt');
});

Route::get('/account', function () {
    return view('account_rpt');
});


// Route::get('/users', function () {
//                     return view('users');
//                 });
