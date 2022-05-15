<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\StageController;

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

// Route::get('/verify', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verify');

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::post('/Login', 'App\Http\Controllers\Auth\LoginController@Login')->name('Login');

Route::group(['middleware' => 'auth', 'verified'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
});

Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']])->middleware(['auth', 'idrole']);
Route::get('map', function () {return view('pages.maps');})->name('map')->middleware(['auth', 'idrole']);


/* Route::get('escenarios', [App\Http\Controllers\StageController::class, 'index'])->name('stage')->middleware(['auth', 'idrole']);
Route::get('escenarios/add', [App\Http\Controllers\StageController::class, 'create'])->name('stage.add')->middleware(['auth', 'idrole']);
Route::post('escenario', [App\Http\Controllers\StageController::class, 'store'])->name('stage.store')->middleware(['auth', 'idrole']);
Route::delete('escenario/delete/{id}', [App\Http\Controllers\StageController::class, 'destroy'])->name('stage.destroy')->middleware(['auth', 'idrole']); */

Route::resource('escenario', App\Http\Controllers\StageController::class);


Route::get('inventarios', function () {return view('pages.inventary');})->name('inventary')->middleware(['auth', 'idrole']);
Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade')->middleware(['auth', 'idrole']); 
Route::get('icons', function () {return view('pages.icons');})->name('icons')->middleware(['auth', 'idrole']); 
Route::get('table-list', function () {return view('pages.tables');})->name('table')->middleware(['auth', 'idrole']);
Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password'])->middleware(['auth', 'idrole']);
