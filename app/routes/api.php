<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// login route
Route::post('/login','Api\Auth\LoginController@login');

// protected api v1 routes
Route::group([
    'middleware' => ['ApiAuth'],
    'prefix' => 'v1'
    ], function(){
    // report end points
    Route::get('/report/{id}', 'Api\v1\ReportController@get');
    Route::post('/report', 'Api\v1\ReportController@create');
    Route::delete('/report/{id}', 'Api\v1\ReportController@delete');
    Route::get('/reports', 'Api\v1\ReportController@get_all');

    // inspection end points
    Route::get('/inspection/{id}', 'Api\v1\InspectionController@get');
    Route::post('/inspection', 'Api\v1\InspectionController@create');
    Route::delete('/inspection/{id}', 'Api\v1\InspectionController@delete');
    Route::get('/inspections', 'Api\v1\InspectionController@get_all');

    // issue end points
    Route::get('/issue/{id}', 'Api\v1\IssueController@get');
    Route::post('/issue', 'Api\v1\IssueController@create');
    Route::delete('/issue/{id}', 'Api\v1\IssueController@delete');
    Route::get('/issues', 'Api\v1\IssueController@get_all');


    //dashboard
    Route::get('/dashboard','Api\v1\DashboardController@get_all');
    
    //templates
    Route::get('/templates', 'Api\v1\TemplateController@get_all');
    Route::get('/template/{id}', 'Api\v1\TemplateController@get');
    Route::post('/template', 'Api\v1\TemplateController@create');
    Route::put('/template/{id}', 'Api\v1\TemplateController@update'); //to do 
    Route::delete('/template/{id}', 'Api\v1\TemplateController@get');




});

