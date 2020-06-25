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
//index
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
//Profile user
Route::get('/profile','HomeController@ShowProfile')->name('profile');
//Edit profile
Route::post('/edit-user','HomeController@EditUser')->name('edit-user');
//Change avatar
Route::put('/edit-avatar','HomeController@EditAvatar')->name('edit-avatar');
//Write absebce letter
Route::post('/create-letter','HomeController@CreateLetter')->name('create-letter');
//get realtime data
Route::get('/real-time/{id?}','HomeController@RealTimeData')->name('real-time');
//Admin function
Route::get('/admin-function','HomeController@Admin')->name('admin-function');
//Aprove the letter
Route::post('/aprrove','HomeController@Approve')->name('approve');
//Reject the letter
Route::post('/dissaprrove','HomeController@Dissapprove')->name('dissapprove');
//get data
Route::get('/get-data','HomeController@GetData')->name('get-data');
//Calender of user
Route::get('/calender','HomeController@Calender')->name('calender');
//Edit employees's salary
Route::put('/addSalary','HomeController@AddSalary')->name('addSalary');
//Print employees's salary
Route::get('/print-PDF/{id_pdf?}','HomeController@PrintPDF')->name('print-PDF');
//simple table
Route::get('/simple', 'HomeController@simple')->name('simple');
//Add house layout
Route::get('/add-house','HomeController@HouseAdd')->name('add-house');
//Add house
Route::post('/add-house','HomeController@addHouse')->name('add-house-now');
//validate location ajax
Route::post('/validate-location','ValidateController@LocationVali')->name('validate-location');
//update locaiton layout
Route::get('/update-location/{id_location?}','HomeController@updateLocation')->name('update-location');

Route::patch('/MakeUpdateLocation/{id_location?}','HomeController@LocationUpdate')->name('make-update-location');
//Update House layout
Route::get('/update/{id_house?}','HomeController@HouseEdit')->name('House-edit');

Route::post('/MakeUpdate/{id_house?}','HomeController@EditHouse')->name('Edit-House');
//delete table House
Route::delete('/simple/{id_house?}','HomeController@destroy')->name('delete');
//delete table location
Route::delete('delete/{id_location?}','HomeController@destroyLocation')->name('delete-Location');
//delete user
Route::delete('delete-user/{user_id?}','HomeController@DestroyUser')->name('delete-user');//add location
Route::get('/add-location','HomeController@LocationAdd')->name('add-location');

Route::post('/add-location-now','HomeController@AddLocation')->name('add-location-now');
Route::post('/EmName','ValidateController@EmName')->name('EmName');
