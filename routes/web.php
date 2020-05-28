<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/todo', 'ToDoController@todo')->name('todo');
Route::get('/todo/update/{id}', 'ToDoController@updatePage')->name('updateTodo');
Route::get('/todo/delete/{id}', 'ToDoController@delete')->name('deleteTodo');

Route::post('/todo/create', 'ToDoController@create');
Route::post('/todo/update/{id}', 'ToDoController@update');

