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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'reset' => false, 
    'verify' => false,
  ]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

//Company
Route::get('company/view', 'Master\CompanyController@companyview')->name('companyview');
Route::get('company/create', 'Master\CompanyController@companycreate')->name('companycreate');
Route::get('company/update', 'Master\CompanyController@companyupdate')->name('companyupdate');
Route::post('company/save', 'Master\CompanyController@companysave')->name('companysave');


//Supplier
Route::get('supplier/view', 'Master\CompanyController@supplierview')->name('supplierview');
Route::get('supplier/create', 'Master\CompanyController@suppliercreate')->name('suppliercreate');
Route::get('supplier/update', 'Master\CompanyController@supplierupdate')->name('supplierupdate');
Route::post('supplier/save', 'Master\CompanyController@suppliersave')->name('suppliersave');