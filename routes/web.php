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

use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'manage',  'middleware' => 'auth'], function()
{
	Route::resource('organization', OrganizationController::class);
	Route::resource('location', LocationController::class);
	Route::resource('layout', LayoutController::class);
	Route::resource('user', UserController::class);
});

Auth::routes([
	'register' => false,
	'verify' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
