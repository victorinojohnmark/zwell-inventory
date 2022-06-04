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
Route::get('supplier/view', 'Master\SupplierController@supplierview')->name('supplierview');
Route::get('supplier/create', 'Master\SupplierController@suppliercreate')->name('suppliercreate');
Route::get('supplier/update', 'Master\SupplierController@supplierupdate')->name('supplierupdate');
Route::post('supplier/save', 'Master\SupplierController@suppliersave')->name('suppliersave');

//Contractor
Route::get('contractor/view', 'Master\ContractorController@contractorview')->name('contractorview');
Route::get('contractor/create', 'Master\ContractorController@contractorcreate')->name('contractorcreate');
Route::get('contractor/update', 'Master\ContractorController@contractorupdate')->name('contractorupdate');
Route::post('contractor/save', 'Master\ContractorController@contractorsave')->name('contractorsave');

//Location
Route::get('location/view', 'Master\LocationController@locationview')->name('locationview');
Route::get('location/create', 'Master\LocationController@locationcreate')->name('locationcreate');
Route::get('location/update', 'Master\LocationController@locationupdate')->name('locationupdate');
Route::post('location/save', 'Master\LocationController@locationsave')->name('locationsave');

//Item
Route::get('item/view', 'Master\ItemController@itemview')->name('itemview');
Route::get('item/create', 'Master\ItemController@itemcreate')->name('itemcreate');
Route::get('item/update', 'Master\ItemController@itemupdate')->name('itemupdate');
Route::post('item/save', 'Master\ItemController@itemsave')->name('itemsave');
