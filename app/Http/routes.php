<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use LucaDegasperi\OAuth2Server\Facades\Authorizer;

Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccesstoken());
});

Route::group(['middleware' => 'oauth'], function () {

    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function () {
        /**
         * Members
         */
        Route::get('{id}/members', 'ProjectMemberController@get');
        Route::post('{id}/member/{idMember}', 'ProjectMemberController@add');
        Route::delete('{id}/member/{idMember}', 'ProjectMemberController@remove');
        Route::get('{id}/member/{idMember}/have', 'ProjectMemberController@have');

        /**
         * Notes
         */
        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{idNote}', 'ProjectNoteController@show');
        Route::put('{id}/note/{idNote}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{idNote}', 'ProjectNoteController@destroy');

        /**
         * Tasks
         */
        Route::get('{id}/task', 'ProjectTaskController@index');
        Route::post('{id}/task', 'ProjectTaskController@store');
        Route::get('{id}/task/{idTask}', 'ProjectTaskController@show');
        Route::put('{id}/task/{idTask}', 'ProjectTaskController@update');
        Route::delete('{id}/task/{idTask}', 'ProjectTaskController@destroy');

        /**
         * Files
         */
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::delete('{filename}/file', 'ProjectFileController@destroy');
    });

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
