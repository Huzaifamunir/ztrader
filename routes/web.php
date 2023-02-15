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




/* Previous Routes  */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {


     Route::resource('roles', RoleController::class)->middleware('role:admin');
     Route::resource('users', UserController::class); //->middleware('role:admin');
     Route::resource('products', ProductController::class)->middleware('role:admin');
     Route::resource('permissions', PermissionController::class)->middleware('role:admin');
     Route::resource('companies',CompanyController::class);  // ->middleware('role:superadmin');
     /* Menu routes  */
     Route::get('/menu', function () {
         return view('menu');
     })->name('menu');

     Route::get('profile/{id}', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');

     Route::post('editprofile', [App\Http\Controllers\ProfileController::class, 'editprofile'])->name('editprofile');



    //  Bank Routes
    Route::get('show_bank',[App\Http\Controllers\BankController::class,'show_bank'])->name('show_bank');
    Route::post('Add_bank',[App\Http\Controllers\BankController::class,'Add_bank'])->name('Add_bank');


  

    //  Transiction Routes
     Route::get('transiction/{id}', [App\Http\Controllers\BankController::class, 'transiction'])->name('transiction');
     Route::post('Add_Transiction',[App\Http\Controllers\BankController::class,'Add_Transiction'])->name('Add_Transiction');


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
     Route::get('/provider_delete/{id}', [App\Http\Controllers\ProviderController::class, 'provider_delete'])->name('provider_delete');

     Route::get('/getsubcategories', [App\Http\Controllers\ProductController::class, 'getsubcategories'])->name('getsubcategories');

     /* Resource routes  */
     Route::resource('sub_category','App\Http\Controllers\SubCategoryController');
     Route::resource('main_category','App\Http\Controllers\MainCategoryController');


     Route::get('/main_category/search','App\Http\Controllers\MainCategoryController@search')->name('main_category.search');
     Route::get('/user_list', [App\Http\Controllers\StockController::class, 'user_list'])->name('user_list');
     Route::get('/product_list', [App\Http\Controllers\StockController::class, 'product_list'])->name('product_list');


     Route::get('get_cash_user/{id}', [App\Http\Controllers\SaleController::class, 'get_cash_user'])->name('get_cash_user');

     Route::get('ledger/{id}', [App\Http\Controllers\LedgerController::class, 'index'])->name('ledger');
     
   

     Route::resource('country','App\Http\Controllers\CountryController');
     Route::resource('state','App\Http\Controllers\StateController');
     Route::resource('city','App\Http\Controllers\CityController');
     Route::resource('product','App\Http\Controllers\ProductController');
     Route::resource('stock','App\Http\Controllers\StockController');
     Route::resource('sale','App\Http\Controllers\SaleController');
     Route::resource('payment','App\Http\Controllers\PaymentController');

     Route::resource('user','App\Http\Controllers\UserController');
     Route::resource('product','App\Http\Controllers\ProductController');
     Route::resource('client','App\Http\Controllers\ClientController');
     Route::resource('bank','App\Http\Controllers\BankController');

    Route::get('/dashboard/today_sales',[App\Http\Controllers\HomeController::class, 'today_sale'])->name('dashboard.today_sales');

    Route::get('/dashboard/profit_loss',[App\Http\Controllers\HomeController::class, 'profit_loss'])->name('dashboard.profit_loss');

	Route::post('/dashboard/profit_loss',[App\Http\Controllers\HomeController::class, 'profit_loss'])->name('dashboard.profit_loss');
    
    Route::post('/dashboard/date_sales',[App\Http\Controllers\HomeController::class, 'date_sales'])->name('dashboard.date_sales');

    Route::get('/dashboard/current_stock',[App\Http\Controllers\HomeController::class, 'current_stock'])->name('dashboard.current_stock');

    Route::get('/dashboard/report',[App\Http\Controllers\HomeController::class, 'report'])->name('dashboard.report');

    Route::get('/dashboard/product',[App\Http\Controllers\HomeController::class, 'product'])->name('dashboard.product');

    });
