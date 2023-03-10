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

use Illuminate\Support\Facades\Route;

Route::get('/', 'EmailsLogController@index')->name('index');
Route::post('/send_email', 'PersonController@send')->name('send_email');
Route::delete('/delete_email/{id}', 'EmailsLogController@delete')->name('delete_email');
