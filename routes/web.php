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

Route::post('/login', 'Auth\LoginController@login')->name('auth.login');
Route::post('/register', 'Auth\RegisterController@create')->name('auth.register');
Route::post('/reset-password-code', 'Auth\ForgotPasswordController@addCode')->name('code.add');
Route::put('/reset-password', 'Auth\ResetPasswordController@resetPassword')->name('reset.password');
Route::get('/check-pass-code', 'Auth\ResetPasswordController@checkPassCode')->name('code.check');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/nurse', 'NurseController@index')->name('nurse');
Route::get('/admin', 'AdminController@index')->name('admin');
