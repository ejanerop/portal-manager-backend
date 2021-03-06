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

Route::get('/ip', 'MainController@getIpAddress');
Route::post('/ip', 'MainController@ipAddressExists');
Route::get('/ip_portal', 'MainController@currentPortalByIp');

Route::apiResource('client', 'ClientController');
Route::get('/client_type', 'ClientController@clientTypes');
Route::get('/ip_client', 'ClientController@clientByIp');
Route::apiResource('portal', 'PortalController');
Route::get('/client_logout', 'MainController@logout');
