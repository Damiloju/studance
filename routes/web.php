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
})->middleware('guest');

Route::post('/login', 'AuthController@authenticateUser');
Route::get('/logout', 'AuthController@logout')->middleware('auth');

Route::group(['prefix' => 'backend', 'middleware' => 'super',], function (){
   Route::get('/dashboard','AdminController@index')->name('home');

   Route::get('/students','StudentController@index')->name('students');
   Route::post('/students', 'StudentController@store');

   Route::get('/programs', 'ProgramController@getPrograms');

   Route::post('/event/create', 'EventController@store');
   Route::post('/event/delete/{event}', 'EventController@delete');
   Route::get('/event/{event}', 'EventController@index');

   Route::post('/records/add', 'RecordController@store');

});
