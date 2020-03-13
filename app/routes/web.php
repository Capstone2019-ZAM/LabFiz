<?php
// Use App\Dashboard;
// Use App\Template;

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
Route::group(['middleware' => ['role:admin|inspector|student']], function(){
   // Route::get('/home', 'HomeController@index')->name('home');
   
    Route::get('/home', function () {
        return view('dashboardPage');
    });
    Route::get('/dashboard', function () {
        return view('dashboardPage');
    });

});

// admin routes
Route::group(['middleware' => ['role:admin']], function(){
    //Route::get('/admin','AdminController@index')->name('index');
    Route::get('/templates', function () {
        return view('template_rpt');
    });
    // Route::get('/template/{id}', function () {
    //     return view('template_builder');
    // });
    
    Route::get('/template/{id}', function () {
        return view('template_builder');
    });
    Route::get('/template', function () {
        return view('template_builder');
    });
    Route::get('/account', function () {
        return view('account_rpt');
    });
    Route::get('/account/{id}', function () {
        return view('account_rpt');
    });
    Route::get('/accounts', function () {
        return view('account');
    });
    Route::get('/restore', function () {
        return view('restore');
    });
    Route::get('/assignments', function () {
        return view('assignment_rpt');
    });
});


Route::group(['middleware' => ['role:admin|inspector']], function(){

    Route::get('/myassignments', function () {
        return view('assignment_my_rpt');
    });
    Route::get('/assignment/{id}', function () {
        return view('assignment');
    });
    Route::get('/issue/{id}', function () {
        return view('issue_rpt');
    });
    Route::get('/issue', function () {
        return view('issue_rpt');
    });
    Route::get('/issues', function () {
        return view('issue');
    });
    
});





