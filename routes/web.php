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

Route::get('vision','GoogleController@index');
Route::post('vision','GoogleController@submit')->name('submit');

Route::get('php','GoogleController@php');
Route::get('upload','GoogleController@upload');
Route::get('/calendar', function () {
    return view('calendar');
});
Route::get('/date','CalenderController@create');
Route::post('/calculate','CalenderController@store')->name('calculate');
