<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {

    Route::apiResource('client', 'ClientController');
    Route::apiResource('portal', 'PortalController');
    Route::get('/client_type', 'ClientController@clientTypes');
    Route::get('/permission', 'ClientController@permissions');

});

//todos los usuarios

Route::get('/log', 'LogController@index')->middleware('user.can:see-logs');

Route::get('/ip', 'MainController@getIpAddress');
Route::post('/ip', 'MainController@ipAddressExists');
Route::get('/ip_info', 'MainController@currentClientByIp');
Route::get('/ip_client', 'ClientController@clientByIp');
Route::get('/client_in_portal/{portal}', 'MainController@clientsInPortal');

Route::get('/client_logout/{client?}', 'ConnectionController@logout'); //parametro client solo admin
Route::get('/change/{portal}/{client?}', 'ConnectionController@change'); //parametro client solo admin
Route::get('/close/{portal}', 'ConnectionController@close')->middleware('user.can:close-portals');


Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');


