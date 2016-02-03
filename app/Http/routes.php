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

//Route::group(['middleware' => 'oauth'], function () {

    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    /**
     * Route::group(['middleware' => 'check-project-owner'], function () {
     * Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);
     * });
     */

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
    });

    /**
     * Route::get('client',['middleware' => 'oauth', 'uses' => 'ClientController@index']);
     * Route::post('client', 'ClientController@store');
     * Route::get('client/{id}', 'ClientController@show');
     * Route::delete('client/{id}', 'ClientController@destroy');
     * Route::put('client/{id}', 'ClientController@update');
     *
     * Route::get('project/{id}/members', 'ProjectMemberController@get');
     * Route::post('project/{id}/member/{idMember}', 'ProjectMemberController@add');
     * Route::delete('project/{id}/member/{idMember}', 'ProjectMemberController@remove');
     * Route::get('project/{id}/member/{idMember}/have', 'ProjectMemberController@have');
     *
     * Route::get('project/{id}/note', 'ProjectNoteController@index');
     * Route::post('project/{id}/note', 'ProjectNoteController@store');
     * Route::get('project/{id}/note/{idNote}', 'ProjectNoteController@show');
     * Route::put('project/{id}/note/{idNote}', 'ProjectNoteController@update');
     * Route::delete('project/{id}/note/{idNote}', 'ProjectNoteController@destroy');
     *
     * Route::get('project/{id}/task', 'ProjectTaskController@index');
     * Route::post('project/{id}/task', 'ProjectTaskController@store');
     * Route::get('project/{id}/task/{idTask}', 'ProjectTaskController@show');
     * Route::put('project/{id}/task/{idTask}', 'ProjectTaskController@update');
     * Route::delete('project/{id}/task/{idTask}', 'ProjectTaskController@destroy');
     *
     * Route::get('project', 'ProjectController@index');
     * Route::post('project', 'ProjectController@store');
     * Route::get('project/{id}', 'ProjectController@show');
     * Route::delete('project/{id}', 'ProjectController@destroy');
     * Route::put('project/{id}', 'ProjectController@update');
     */
//});


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
