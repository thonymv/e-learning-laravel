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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/courses/{id}/modules', 'HomeController@modules')->name('modules');
Route::get('/courses/{id_course}/modules/{id_module}/lessons', 'HomeController@lessons')->name('lessons');
Route::get('/courses/{id_course}/modules/{id_module}/lessons/{id_lesson}/nodes', 'HomeController@nodes')->name('nodes');

Route::post('/courses/{id_course}/modules/{id_module}/lessons/{id_lesson}/nodes', 'HomeController@node_content_register')->name('node_content');
