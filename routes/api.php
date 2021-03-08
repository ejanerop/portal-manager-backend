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

//solo admins

Route::apiResource('client', 'ClientController');
Route::apiResource('portal', 'PortalController');
Route::get('/client_type', 'ClientController@clientTypes');
Route::get('/close/{portal}', 'MainController@close');
Route::get('/log', 'LogController@index'); //por ahora solo admin


//todos los usuarios

Route::get('/ip', 'MainController@getIpAddress');
Route::post('/ip', 'MainController@ipAddressExists');
Route::get('/ip_portal', 'MainController@currentPortalByIp');
Route::get('/ip_client', 'ClientController@clientByIp');
Route::get('/client_logout/{client?}', 'MainController@logout'); //parametro client solo admin
Route::get('/change/{portal}/{client?}', 'MainController@change'); //parametro client solo admin


