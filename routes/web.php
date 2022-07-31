<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\StageController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MiscListStatesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\MiscListStatesInventaryController;

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

// Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/parametrizaciones', [App\Http\Controllers\HomeController::class, 'save_misclist'])->name('save_misclist');

// main page
Route::get('/', 'App\Http\Controllers\IndexController@index')->name('main');

// Route::get('/verify', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verify');

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// user login
Route::post('/Login', 'App\Http\Controllers\Auth\LoginController@Login')->name('Login');

// update & edit user info

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
});

// register users
Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']])->middleware(['auth', 'idrole']);

// maps
Route::get('map', function () {return view('pages.Maps.stagesLocations');})->name('map')->middleware(['auth', 'idrole']);

// generate PDF for stages
Route::get('genpdf/{id}', 'App\Http\Controllers\StageController@pdfStageGeneral')->name('genpdf')->middleware(['auth', 'idrole']);

// disciplines
Route::resource('discipline', App\Http\Controllers\DisciplinesController::class)->middleware(['auth', 'idrole']);

// generate PDF for understages
Route::get('genunderstpdf{idUnderstage}', 'App\Http\Controllers\UnderstageController@pdfUnderstageGeneral')->name('genunderstpdf')->middleware(['auth', 'idrole']);

// stages
Route::resource('escenario', App\Http\Controllers\StageController::class)->middleware(['auth', 'idrole']);
Route::get('listStages', 'App\Http\Controllers\StageController@listStages')->name('listStages');
Route::get('show/{id}', 'App\Http\Controllers\StageController@show')->name('show');
Route::get('viewStageInfo/{id}', 'App\Http\Controllers\StageController@viewStageInfo')->name('viewStageInfo')->middleware(['auth', 'idrole']);

// understages
Route::resource('understage', App\Http\Controllers\UnderstageController::class)->middleware(['auth', 'idrole']);
Route::get('listUnderSt', 'App\Http\Controllers\UnderstageController@listUnderSt')->name('listUnderSt');
Route::get('showUnderSt/{idUnderstage}', 'App\Http\Controllers\UnderstageController@show')->name('showUnderSt');

// user profile
Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade')->middleware(['auth', 'idrole']); 
Route::get('icons', function () {return view('pages.icons');})->name('icons')->middleware(['auth', 'idrole']); 
Route::get('table-list', function () {return view('pages.tables');})->name('table')->middleware(['auth', 'idrole']);
Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password'])->middleware(['auth', 'idrole']);

//MiscListStates
Route::resource('states', App\Http\Controllers\MiscListStatesController::class)->middleware(['auth', 'idrole']);
Route::resource('inventarystates', App\Http\Controllers\MiscListStatesInventaryController::class)->middleware(['auth', 'idrole']);

//Config
Route::resource('config', App\Http\Controllers\ConfigurationController::class)->middleware(['auth', 'idrole']);

//Inventary
Route::resource('item', App\Http\Controllers\ResourcesController::class)->middleware(['auth', 'idrole']);
Route::resource('almacen', App\Http\Controllers\WarehouseController::class)->middleware(['auth', 'idrole']);
