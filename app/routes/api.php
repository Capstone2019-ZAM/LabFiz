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

// user(s) routes
Route::post('/user/login','Api\Auth\LoginController@login');

Route::group([
    'middleware' => ['auth:api'], ], function(){
    Route::post('/user/refresh', 'Api\Auth\LoginController@refresh');
});

Route::group([
    'middleware' => ['auth:api'],
], function() {
    Route::post('/user/register', 'Api\Auth\LoginController@register')->middleware('admin_only');
    Route::get('/user/{id}','Api\Auth\LoginController@get');
    Route::get('/users', 'Api\Auth\LoginController@get_all')->middleware(['admin_only']);
    Route::get('/logout', 'Api\Auth\LoginController@logout');
    Route::get('/user',function(Request $request){
        return $request->user();
    });
});

// protected api v1 routes
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'v1'
    ], function(){

    // report end routes
    Route::get('/report/{id}', 'Api\v1\ReportController@get');
    Route::post('/report', 'Api\v1\ReportController@create');
    Route::delete('/report/{id}', 'Api\v1\ReportController@delete');
    Route::get('/reports', 'Api\v1\ReportController@get_all');

    // inspection routes
    Route::get('/inspection/{id}', 'Api\v1\InspectionController@get');
    Route::post('/inspection', 'Api\v1\InspectionController@create');
    Route::delete('/inspection/{id}', 'Api\v1\InspectionController@delete');
    Route::get('/inspections', 'Api\v1\InspectionController@get_all');

    // issue routes
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
    Route::delete('/template/{id}', 'Api\v1\TemplateController@delete');

    //lab
    Route::get('/labs', 'Api\v1\LabController@get_all');
    Route::get('/lab/{id}', 'Api\v1\LabController@get');
    Route::post('/lab', 'Api\v1\LabController@create');
    Route::delete('/lab/{id}', 'Api\v1\LabController@delete');

    //comment
    Route::get('/comments', 'Api\v1\CommentController@get_all');
    Route::get('/comment/{id}', 'Api\v1\CommentController@get');
    Route::post('/comment', 'Api\v1\CommentController@create');
    Route::delete('/comment/{id}', 'Api\v1\CommentController@delete');
});

