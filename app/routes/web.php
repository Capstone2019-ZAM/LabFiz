<?php
Use App\Dashboard;
Use App\Template;

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


Route::get('/dashboard', function () {
    return view('dashboardPage');
});



Route::get('/templates', function () {
    return view('template_rpt');
});
Route::get('/template/{id}', function () {
    return view('template_builder');
});

Route::get('/template_builder', function () {
    return view('template_builder');
});
Route::get('/assignments', function () {
    return view('assignment_rpt');
});
Route::get('/assignment', function () {
    return view('assignment');
});
Route::get('/issueform', function () {
    return view('issue_rpt');
});
Route::get('/newaccount', function () {
    return view('account_rpt');
});
Route::get('/issue', function () {
    return view('issue');
});
Route::get('/account', function () {
    return view('account');
});
