<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
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

Route::post('get_route_stations', [HomeController::class, 'get_route_stations']);
Route::post('get_station_routes', [HomeController::class, 'get_station_routes']);

Route::post('store_ticket', [TicketController::class, 'store']);
Route::post('calc_sum_total', [TicketController::class, 'calc_sum_total']);
Route::post('get_tickets', [TicketController::class, 'get_tickets']);

Route::post('get_routes', [RouteController::class, 'get_routes']);

Route::post('get_stations', [StationController::class, 'get_stations']);
