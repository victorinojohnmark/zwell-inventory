<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => ['auth']], function() {

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
Route::post('item/getunit', 'Master\ItemController@itemgetunit')->name('itemgetunit');

## TRANSACTION RECORD ##

//Purchase Order
Route::get('purchaseorder/view', 'Transaction\PurchaseOrderController@purchaseorderview')->name('purchaseorderview');
Route::get('purchaseorder/create', 'Transaction\PurchaseOrderController@purchaseordercreate')->name('purchaseordercreate');
Route::get('purchaseorder/update', 'Transaction\PurchaseOrderController@purchaseorderupdate')->name('purchaseorderupdate');
Route::post('purchaseorder/save', 'Transaction\PurchaseOrderController@purchaseordersave')->name('purchaseordersave');
Route::get('purchaseorder/search/{searchKey}', 'Transaction\PurchaseOrderController@purchaseordersearch')->name('purchaseordersearch');
Route::post('purchaseorder/confirm', 'Transaction\PurchaseOrderController@purchaseorderconfirm')->name('purchaseorderconfirm');
Route::post('purchaseorder/approve', 'Transaction\PurchaseOrderController@purchaseorderapprove')->name('purchaseorderapprove');
Route::post('purchaseorder/draft', 'Transaction\PurchaseOrderController@purchaseorderdraft')->name('purchaseorderdraft');
Route::get('purchaseorder/print', 'Transaction\PurchaseOrderController@purchaseorderprint')->name('purchaseorderprint');


//Purchase Order Detail
Route::post('purchaseorderdetail/save', 'Transaction\PurchaseOrderDetailController@purchaseorderdetailsave')->name('purchaseorderdetailsave');
Route::post('purchaseorderdetail/delete', 'Transaction\PurchaseOrderDetailController@purchaseorderdetaildelete')->name('purchaseorderdetaildelete');

//Delivery
Route::get('delivery/view', 'Transaction\DeliveryController@deliveryview')->name('deliveryview');
Route::get('delivery/create', 'Transaction\DeliveryController@deliverycreate')->name('deliverycreate');
Route::get('delivery/update', 'Transaction\DeliveryController@deliveryupdate')->name('deliveryupdate');
Route::post('delivery/save', 'Transaction\DeliveryController@deliverysave')->name('deliverysave');
Route::post('delivery/confirm', 'Transaction\DeliveryController@deliveryconfirm')->name('deliveryconfirm');
Route::post('delivery/approve', 'Transaction\DeliveryController@deliveryapprove')->name('deliveryapprove');
Route::post('delivery/draft', 'Transaction\DeliveryController@deliverydraft')->name('deliverydraft');

//Delivery Detail

Route::post('deliverydetail/update', 'Transaction\DeliveryDetailController@deliverydetailupdate')->name('deliverydetailupdate');
Route::post('deliverydetail/save', 'Transaction\DeliveryDetailController@deliverydetailsave')->name('deliverydetailsave');
Route::post('deliverydetail/delete', 'Transaction\DeliveryDetailController@deliverydetaildelete')->name('deliverydetaildelete');

//File Attachment
Route::post('/fileattachment/upload/{transactionType}/{transactionID}/{userID}', 'System\FileAttachmentController@fileattachmentupload')->name('fileattachmentupload');
Route::post('/fileattachment/delete/{fileid}', 'System\FileAttachmentController@fileattachmentdelete')->name('fileattachmentdelete');

});







