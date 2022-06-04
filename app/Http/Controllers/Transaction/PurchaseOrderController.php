<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transaction\PurchaseOrder;

use App\System\LogicCRUD;

class PurchaseOrderController extends Controller
{
    public function purchaseorderview(Request $request)
    {
        if(isset($request->id)) {
            return view('transaction.purchaseorder.purchaseorderform', [
                'purchaseOrder' => LogicCRUD::retrieveRecord('PurchaseOrder', 'Transaction', $request->id)
            ]);
        } 

        else {
            return view('transaction.purchaseorder.purchaseorderlist', [
                'purchaseOrders' => LogicCRUD::retrieveRecord('PurchaseOrder', 'Transaction', null, 50)
            ]);
        }
    }

    public function purchaseordercreate()
    {
        return view('transaction.purchaseorder.purchaseorderform', [
            'purchaseOrder' => LogicCRUD::createRecord('PurchaseOrder', 'Transaction'),
        ]);
    }

    public function purchaseorderupdate(Request $request)
    {
        if(!is_null($request->id)) {
            return view('transaction.purchaseorder.purchaseorderform', [
                'purchaseOrder' => LogicCRUD::retrieveRecord('PurchaseOrder', 'Transaction', $request->id),
            ]);
        } else {
            return redirect()->back();
        }

        
    }

    public function purchaseordersave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('PurchaseOrder', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('purchaseorderview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function purchaseorderdelete()
    {

    }
}
