<?php



Route::get('/', function () {
    return view('welcome');
});

Route::get('/client', 'ClientController@index');
Route::post('/client', 'ClientController@store');
Route::get('/client/{id}', 'ClientController@show');
Route::delete('/client/{id}', 'ClientController@destroy');
Route::put('/client/{id}', 'ClientController@update');

Route::get('/project/{id}/note', 'ProjectNoteController@index');
Route::post('/project/{id}/note', 'ProjectNoteController@store');
Route::get('/project/{id}/note/{noteId}', 'ProjectNoteController@show');
Route::delete('/project/{id}/note/{noteId}', 'ProjectNoteController@destroy');
Route::put('/project/{id}/note/{noteId}', 'ProjectNoteController@update');

Route::get('/project/{id}/task', 'ProjectTaskController@index');
Route::post('/project/{id}/task', 'ProjectTaskController@store');
Route::get('/project/{id}/task/{taskId}', 'ProjectTaskController@show');
Route::delete('/project/{id}/task/{taskId}', 'ProjectTaskController@destroy');
Route::put('/project/{id}/task/{taskId}', 'ProjectTaskController@update');

Route::get('/project/{id}/member', 'ProjectController@members');
Route::post('/project/{id}/member', 'ProjectController@add_member');
Route::delete('/project/{id}/member', 'ProjectController@remove_member');

Route::get('/project', 'ProjectController@index');
Route::post('/project', 'ProjectController@store');
Route::get('/project/{id}', 'ProjectController@show');
Route::delete('/project/{id}', 'ProjectController@destroy');
Route::put('/project/{id}', 'ProjectController@update');

