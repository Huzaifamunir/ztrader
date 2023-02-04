<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use  Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::resource('companies',CompanyController::class);  // ->middleware('role:superadmin');

/* Client routes  */
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::get('/client_create', [App\Http\Controllers\ClientController::class, 'client_create'])->name('client_create');
Route::post('/client_add', [App\Http\Controllers\ClientController::class, 'client_add'])->name('client_add');


/* Provider routes  */
Route::get('/provider', [App\Http\Controllers\ProviderController::class, 'index'])->name('provider');
Route::get('/provider_create', [App\Http\Controllers\ProviderController::class, 'provider_create'])->name('provider_create');


/* Previous Routes  */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {


     Route::resource('roles', RoleController::class)->middleware('role:admin');
     Route::resource('users', UserController::class); //->middleware('role:admin');
     Route::resource('products', ProductController::class)->middleware('role:admin');
     Route::resource('permissions', PermissionController::class)->middleware('role:admin');


    });
