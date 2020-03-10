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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/compare', 'HomeController@compare');
Route::post('/upload', 'HomeController@upload')->name('upload');
Route::get('/results', 'HomeController@results')->name('results');
Route::get('/clear', 'HomeController@clear')->name('clear');
