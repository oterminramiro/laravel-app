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
use App\Http\Controllers\UserManagerController;
use App\Http\Controllers\UserOperatorController;
use App\Http\Controllers\AccountController;

Route::group(['prefix' => 'manage',  'middleware' => 'auth'], function()
{
	Route::resource('organizations', OrganizationController::class);
	Route::resource('locations', LocationController::class);
	Route::resource('layouts', LayoutController::class);
	Route::group(['prefix' => 'users'], function()
	{
		Route::resource('managers', UserManagerController::class);
		Route::resource('operators', UserOperatorController::class);
		Route::get('/login_as/{guid:slug}', [AccountController::class, 'login_as'])->name('login_as');
		Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
	});
});

Auth::routes([
	'register' => false,
	'verify' => false,
	'logout' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/log_as', [App\Http\Controllers\HomeController::class, 'log_as'])->name('log_as');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
