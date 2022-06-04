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

## MASTER RECORD ##

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
Route::get('contractor/view', 'Master\ContractorController@itemview')->name('contractorview');
Route::get('contractor/create', 'Master\ContractorController@itemcreate')->name('contractorcreate');
Route::get('contractor/update', 'Master\ContractorController@itemupdate')->name('contractorupdate');
Route::post('contractor/save', 'Master\ContractorController@itemsave')->name('contractorsave');

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

## TRANSACTION RECORD ##

//Purchase Order
Route::get('purchaseorder/view', 'Transaction\PurchaseOrderController@purchaseorderview')->name('purchaseorderview');
Route::get('purchaseorder/create', 'Transaction\PurchaseOrderController@purchaseordercreate')->name('purchaseordercreate');
Route::get('purchaseorder/update', 'Transaction\PurchaseOrderController@purchaseorderupdate')->name('purchaseorderupdate');
Route::post('purchaseorder/save', 'Transaction\PurchaseOrderController@purchaseordersave')->name('purchaseordersave');