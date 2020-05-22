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

Route::group(['middleware' => ['web']], function() {
    Route::get('/', [
        'uses' => 'NoteController@getNotes',
        'as' => 'notes'
    ]);

    Route::post('/new', [
        'uses' => 'NoteController@postNote',
        'as' => 'create'
    ]);

    Route::get('/delete/{note_id}', [
        'uses' => 'NoteController@deleteNote',
        'as' => 'delete'
    ]);
});
