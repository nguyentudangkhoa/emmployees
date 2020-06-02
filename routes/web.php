<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile','HomeController@ShowProfile')->name('profile');
Route::post('/edit-user','HomeController@EditUser')->name('edit-user');
Route::put('/edit-avatar','HomeController@EditAvatar')->name('edit-avatar');
Route::post('/create-letter','HomeController@CreateLetter')->name('create-letter');
Route::get('/real-time/{id?}','HomeController@RealTimeData')->name('real-time');
Route::get('/admin-function','HomeController@Admin')->name('admin-function');
Route::post('/aprrove','HomeController@Approve')->name('approve');
Route::post('/dissaprrove','HomeController@Dissapprove')->name('dissapprove');
