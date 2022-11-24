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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrandstandController;

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

// email verification
// Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
// Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

// Route::get('/verify', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verify');

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// user login
Route::post('/Login', 'App\Http\Controllers\Auth\LoginController@Login')->name('Login');

// list users
Route::get('/users', 'App\Http\Controllers\UserController@listUsers')->name('users')->middleware(['auth', 'idrole']);
Route::put('/users/updaterol', 'App\Http\Controllers\UserController@updateRol')->name('updateRol')->middleware(['auth', 'idrole']);
Route::get('/user/{id}', 'App\Http\Controllers\UserController@ShowUser')->middleware(['auth', 'idrole']);
Route::put('/user/{id}/edit', 'App\Http\Controllers\UserController@UpdateUserForm')->middleware(['auth', 'idrole']);

// update & edit user info
Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
});

// register users
Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']])->middleware(['auth', 'idrole']);

// maps
Route::get('map', function () {
	return view('pages.Maps.stagesLocations');
})->name('map')->middleware(['auth', 'idrole']);

// generate PDF for stages
Route::get('genpdf/{id}', 'App\Http\Controllers\StageController@pdfStageGeneral')->name('genpdf')->middleware(['auth', 'idrole']);

// disciplines
Route::resource('discipline', App\Http\Controllers\DisciplinesController::class)->middleware(['auth', 'idrole']);

// Graderías
Route::resource('grandstand', App\Http\Controllers\GrandstandController::class)->middleware(['auth', 'idrole']);

// generate PDF for understages
Route::get('genunderstpdf{idUnderstage}', 'App\Http\Controllers\UnderstageController@pdfUnderstageGeneral')->name('genunderstpdf')->middleware(['auth', 'idrole']);

// stages
Route::resource('escenario', App\Http\Controllers\StageController::class)->middleware(['auth', 'idrole']);
Route::get('listStages', 'App\Http\Controllers\StageController@listStages')->name('listStages');
Route::get('show/{id}', 'App\Http\Controllers\StageController@show')->name('show');
Route::get('viewStageInfo/{id}', 'App\Http\Controllers\StageController@viewStageInfo')->name('viewStageInfo')->middleware(['auth', 'idrole']);
Route::get('score/{id}', 'App\Http\Controllers\StageController@updateScore');
Route::get('mapaescenarios', 'App\Http\Controllers\StageController@mapaescenarios');
Route::get('viewresourcesmain/{id}', 'App\Http\Controllers\StageController@viewResourcesMain')->name('viewresourcesmain')->middleware(['auth', 'idrole']);

// understages
Route::resource('understage', App\Http\Controllers\UnderstageController::class)->middleware(['auth', 'idrole']);
Route::get('listUnderSt/{id}', 'App\Http\Controllers\UnderstageController@listUnderSt')->name('listUnderSt');
Route::get('showUnderSt/{idUnderstage}', 'App\Http\Controllers\UnderstageController@show')->name('showUnderSt');
Route::get('viewresourcesunderstage/{idUnderstage}', 'App\Http\Controllers\UnderstageController@viewResourcesUnderstage')->name('viewresourcesunderstage')->middleware(['auth', 'idrole']);

// user profile
Route::get('upgrade', function () {
	return view('pages.upgrade');
})->name('upgrade')->middleware(['auth', 'idrole']);
Route::get('icons', function () {
	return view('pages.icons');
})->name('icons')->middleware(['auth', 'idrole']);
Route::get('table-list', function () {
	return view('pages.tables');
})->name('table')->middleware(['auth', 'idrole']);
Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password'])->middleware(['auth', 'idrole']);

//MiscListStates
Route::resource('states', App\Http\Controllers\MiscListStatesController::class)->middleware(['auth', 'idrole']);
Route::resource('inventarystates', App\Http\Controllers\MiscListStatesInventaryController::class)->middleware(['auth', 'idrole']);

//Config
Route::resource('config', App\Http\Controllers\ConfigurationController::class)->middleware(['auth', 'idrole']);

//Inventary
Route::resource('item', App\Http\Controllers\ResourcesController::class)->middleware(['auth', 'idrole']);
Route::get('/assign/{idResource}/set', 'App\Http\Controllers\ResourcesController@bringResourceInfo')->middleware(['auth', 'idrole'])->name('assign');
Route::get('/see/{idResource}', 'App\Http\Controllers\ResourcesController@bringResourceToResupply')->middleware(['auth', 'idrole'])->name('see');
Route::put('/set/{idResource}', 'App\Http\Controllers\ResourcesController@setInUseItem')->middleware(['auth', 'idrole'])->name('/set/');
Route::put('/setresupply/{idResource}', 'App\Http\Controllers\ResourcesController@setResupply')->middleware(['auth', 'idrole'])->name('/setresupply');
Route::put('/setback/{idResource}', 'App\Http\Controllers\ResourcesController@setBackWarehouse')->middleware(['auth', 'idrole'])->name('/setback');
Route::resource('almacen', App\Http\Controllers\WarehouseController::class)->middleware(['auth', 'idrole']);
Route::get('quantity/{id}', 'App\Http\Controllers\ResourcesController@inventoryQuantityReport')->name('quantity')->middleware(['auth', 'idrole']);
Route::get('testpdf/{id}', 'App\Http\Controllers\ResourcesController@testPDF')->name('testpdf')->middleware(['auth', 'idrole']);
Route::get('viewresources/{warehouseId}', 'App\Http\Controllers\WarehouseController@viewResources')->name('viewresources')->middleware(['auth', 'idrole']);
Route::get('viewresourcessub/{warehouseId}', 'App\Http\Controllers\WarehouseController@viewResourcesSub')->name('viewresourcessub')->middleware(['auth', 'idrole']);

//reports
Route::get('stagereport', 'App\Http\Controllers\StageReportController@index')->middleware(['auth', 'idrole']);
Route::get('viewreport/{id}', 'App\Http\Controllers\StageReportController@viewReport')->name('viewreport')->middleware(['auth', 'idrole']);
Route::get('viewsubreport/{idUnderstage}', 'App\Http\Controllers\StageReportController@viewSubReport')->name('viewsubreport')->middleware(['auth', 'idrole']);
Route::get('resourcereport', 'App\Http\Controllers\ResourcesReportController@index')->middleware(['auth', 'idrole']);
Route::get('viewresourcereport/{id}', 'App\Http\Controllers\ResourcesReportController@viewReport')->name('viewresourcereport')->middleware(['auth', 'idrole']);
Route::get('testreport', 'App\Http\Controllers\StageReportController@testReport')->name('testreport')->middleware(['auth', 'idrole']);
Route::get('viewresupplyreport/{id}', 'App\Http\Controllers\ResourcesReportController@viewResupplyReport')->name('viewresupplyreport')->middleware(['auth', 'idrole']);
Route::get('subresourcereport/{idUnderstage}', 'App\Http\Controllers\ResourcesReportController@viewSubStageReport')->name('subresourcereport')->middleware(['auth', 'idrole']);
Route::get('subresupplyreport/{idUnderstage}', 'App\Http\Controllers\ResourcesReportController@viewSubResupplyReport')->name('subresupplyreport')->middleware(['auth', 'idrole']);
Route::get('historicreport', 'App\Http\Controllers\HistoricReportController@index')->name('historicreport')->middleware(['auth', 'idrole']);
Route::get('historicstages', 'App\Http\Controllers\HistoricReportController@stagesHistoricRecords')->name('historicstages')->middleware(['auth', 'idrole']);
Route::get('historicresources', 'App\Http\Controllers\HistoricReportController@resourcesHistoricRecords')->name('historicresources')->middleware(['auth', 'idrole']);
Route::get('historicusers', 'App\Http\Controllers\HistoricReportController@usersHistoricRecords')->name('historicusers')->middleware(['auth', 'idrole']);

// ratings
route::resource('ratings', app\http\controllers\StageratingsController::class)->middleware(['auth', 'idrole']);

//Contactenos
Route::get('contactenos', function () {
	return view('pages.contact');
})->name('contactenos');;