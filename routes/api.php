<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

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


Route::get('companies', [CompanyController::class, 'companies']);
Route::get('companies/{id}', [CompanyController::class, 'getCompany']);
Route::delete('companies/delete/{id}', [CompanyController::class, 'deleteCompany']);
Route::post('companies/update/{id}', [CompanyController::class, 'updateCompany']);



Route::get('users', [UserController::class, 'users']);
Route::get('users/{id}', [UserController::class, 'getUser']);
//Route::get('users/{id}', [UserController::class, 'getCompanyUsers']);
Route::delete('users/delete/{id}', [UserController::class, 'deleteUser']);
Route::post('users/update/{id}', [UserController::class, 'updateUser']);


Route::get('roles', [RoleController::class, 'roles']);
Route::get('roles/{id}', [RoleController::class, 'getRole']);
Route::delete('roles/delete/{id}', [RoleController::class, 'deleteRole']);
Route::post('roles/update/{id}', [RoleController::class, 'updateRole']);




Route::get('permissions',[PermissionController::class,'permissions']);
Route::get('permissions/{id}',[PermissionController::class,'getPermission']);
Route::delete('permissions/delete/{id}',[PermissionController::class,'deletePermission']);
Route::post('permissions/update/{id}',[PermissionController::class,'updatePermission']);




//Route::resource('roles', RoleController::class);
//Route::resource('users', UserController::class);
//Route::resource('permissions', PermissionController::class);
//Route::resource('companiess', CompanyController::class);
