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
    return view('portal');
})->name('portal')->middleware('user.is.allowed');


Route::get('/logs', 'GamerController@logs')->name('logs')->middleware('user.is.gamer');
Route::get('/logout', 'GamerController@logout')->name('logout')->middleware('user.is.not.gamer');

Route::get('/closeSession/{portal}', 'GamerController@closeSession')->name('closeSession')->middleware('user.is.gamer');
Route::get('/changePortal/{portal}', 'GamerController@changePortal')->name('changePortal')->middleware('user.is.gamer', 'can.change.to.downloads');

Route::get('/toggleScript/{active?}', 'SpecialController@toggleScript')->name('toggleScript');

Route::get('/enableScript', 'SpecialController@enableVpnScript')->name('enableScript');
Route::get('/disableScript', 'SpecialController@disableVpnScript')->name('disableScript');

Route::get('/changeAvenger', 'SpecialController@changeAvenger')->name('changeAvenger');

Route::get('/changeFlasho', 'SpecialController@changeFlasho')->name('changeFlasho');
Route::get('/closeFlasho', 'SpecialController@closeFlasho')->name('closeFlasho');


Route::get('/closeEric', 'SpecialController@closeEric')->name('closeEric');
Route::get('/changeEric/{portal}', 'SpecialController@changeEric')->name('changeEric');

Route::get('/closeSpecial/{portal}', 'SpecialController@closeSpecial')->name('closeSpecial')->middleware('user.is.special');
Route::get('/changeSpecial/{portal}', 'SpecialController@changeSpecial')->name('changeSpecial')->middleware('user.is.special');

Route::get('/closeVerySpecial/{portal}', 'SpecialController@closeVerySpecial')->name('closeVerySpecial');

