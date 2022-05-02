<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('main');

// Route::get('/verify', [VerificationController::class])->name('verify');

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::post('/Login', 'App\Http\Controllers\Auth\LoginController@Login')->name('Login');

Route::group(['middleware' => 'auth', 'verified'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
});

Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']])->middleware(['auth', 'idrole']);
Route::get('map', function () {return view('pages.maps');})->name('map')->middleware(['auth', 'idrole']);
Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade')->middleware(['auth', 'idrole']); 
Route::get('icons', function () {return view('pages.icons');})->name('icons')->middleware(['auth', 'idrole']); 
Route::get('table-list', function () {return view('pages.tables');})->name('table')->middleware(['auth', 'idrole']);
Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password'])->middleware(['auth', 'idrole']);
