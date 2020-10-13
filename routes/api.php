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

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MainController;

Route::group(['prefix' => 'customers'], function(){
	Route::get('/index', [CustomerController::class, 'index']);
	Route::post('/create', [CustomerController::class, 'create']);
	Route::post('/login', [CustomerController::class, 'login']);
});

Route::group(['prefix' => 'main'], function(){
	Route::get('/get_organizations', [MainController::class, 'get_organizations']);
	Route::get('/get_locations', [MainController::class, 'get_locations']);
	Route::get('/get_layouts', [MainController::class, 'get_layouts']);
});
