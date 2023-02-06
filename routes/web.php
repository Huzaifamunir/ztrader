<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use app\Http\Controllers\MainCategoryController;
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
/* Menu routes  */
Route::get('/menu', function () {
	return view('menu');
})->name('menu');

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

Route::get('/getsubcategories', [App\Http\Controllers\ProductController::class, 'getsubcategories'])->name('getsubcategories');

/* Resource routes  */
Route::resource('sub_category','App\Http\Controllers\SubCategoryController');
Route::resource('main_category','App\Http\Controllers\MainCategoryController');

Route::get('/main_category/search','App\Http\Controllers\MainCategoryController@search')->name('main_category.search');
Route::resource('country','App\Http\Controllers\CountryController');
Route::resource('state','App\Http\Controllers\StateController');
Route::resource('city','App\Http\Controllers\CityController');
Route::resource('product','App\Http\Controllers\ProductController');
Route::resource('stock','App\Http\Controllers\StockController');
Route::resource('sale','App\Http\Controllers\SaleController');
Route::resource('payment','App\Http\Controllers\paymentController');


/* Previous Routes  */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {


     Route::resource('roles', RoleController::class)->middleware('role:admin');
     Route::resource('users', UserController::class); //->middleware('role:admin');
     Route::resource('products', ProductController::class)->middleware('role:admin');
     Route::resource('permissions', PermissionController::class)->middleware('role:admin');


    });
