<?php


Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function () {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {


    Route::resource('client', 'clientController', ['except' => 'create', 'edit']);


    Route::resource('project', 'projectController', ['except' => 'create', 'edit']);


    Route::group(['prefix' => 'project', 'middleware' => 'CheckProjectPermissions'], function () {


        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');

        Route::get('{id}/task', 'ProjectTaskController@index');
        Route::post('{id}/task', 'ProjectTaskController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTaskController@show');
        Route::delete('{id}/task/{taskId}', 'ProjectTaskController@destroy');
        Route::put('{id}/task/{taskId}', 'ProjectTaskController@update');

        Route::get('{id}/member', 'ProjectController@members');
        Route::post('{id}/member', 'ProjectController@add_member');
        Route::delete('{id}/member/{memberId}', 'ProjectController@remove_member');

        Route::get('{id}/file', 'ProjectFileController@index');
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::get('{id}/file/{fileId}', 'ProjectFileController@show');
        Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');
        Route::put('{id}/file/{fileId}', 'ProjectFileController@update');
    });


});


