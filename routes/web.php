<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auxiliar-create-users', [App\Http\Controllers\GlobalController::class, 'auxiliardata']);
Route::get('/auxiliar-create-stevedors', [App\Http\Controllers\GlobalController::class, 'auxiliardatastevadors']);
Route::get('/auxiliar-create-transactions', [App\Http\Controllers\GlobalController::class, 'auxiliardatatransactions']);





Route::group(['middleware'=>['auth','admin']], function(){

    Route::resource('admindashboards', 'App\Http\Controllers\Admin\AdminDashboardController');
    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('companies', 'App\Http\Controllers\Admin\CompaniesController');
    Route::resource('stevedors', 'App\Http\Controllers\Admin\StevedorsController');
    Route::resource('transactions', 'App\Http\Controllers\Admin\TransactionsController');
    Route::resource('typeoperations', 'App\Http\Controllers\Admin\TypeOperationsController');


});

Route::group(['middleware'=>['auth','company']], function(){
    Route::resource('company-stevedors', 'App\Http\Controllers\Company\StevedorsController');
    Route::resource('company-transactions', 'App\Http\Controllers\Company\TransactionsController');
    Route::resource('companydashboards', 'App\Http\Controllers\Company\CompanyDashboardController');
    
    

});





Route::get('{view}', ApplicationController::class)->where('view','(.*)')->middleware('auth');
