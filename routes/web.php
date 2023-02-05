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
Route::get('/client_single/{id}', [App\Http\Controllers\ClientController::class, 'client_single'])->name('client_single');
Route::get('/client_edit/{id}', [App\Http\Controllers\ClientController::class, 'client_edit'])->name('client_edit');
Route::post('/client_update', [App\Http\Controllers\ClientController::class, 'client_update'])->name('client_update');


/* Provider routes  */
Route::get('/provider', [App\Http\Controllers\ProviderController::class, 'index'])->name('provider');
Route::get('/provider_create', [App\Http\Controllers\ProviderController::class, 'provider_create'])->name('provider_create');
Route::get('/provider_single/{id}', [App\Http\Controllers\ProviderController::class, 'provider_single'])->name('provider_single');
Route::get('/provider_edit/{id}', [App\Http\Controllers\ProviderController::class, 'provider_edit'])->name('provider_edit');
Route::post('/provider_update', [App\Http\Controllers\ProviderController::class, 'provider_update'])->name('provider_update');
Route::post('/provider_delete/{id}', [App\Http\Controllers\ProviderController::class, 'provider_delete'])->name('provider_delete');


/* Previous Routes  */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {


     Route::resource('roles', RoleController::class)->middleware('role:admin');
     Route::resource('users', UserController::class); //->middleware('role:admin');
     Route::resource('products', ProductController::class)->middleware('role:admin');
     Route::resource('permissions', PermissionController::class)->middleware('role:admin');


    });
