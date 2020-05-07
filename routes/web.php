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

Route::get('/', function () {
    return view('auth/login');
});
Route::post('/recognize', 'Recognizer@recognizeAction');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/history', 'history');

Route::view('/team', 'team');

Route::view('/companies', 'companies');

Route::view('/new_company', 'new_company');

Route::view('/edit_company', 'edit_company');
