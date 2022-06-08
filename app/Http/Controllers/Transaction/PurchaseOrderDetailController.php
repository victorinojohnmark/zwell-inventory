<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transaction\PurchaseOrderDetail;

use App\System\LogicCRUD;

class PurchaseOrderDetailController extends Controller
{
    public function purchaseorderdetailsave(Request $request)
    {
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('PurchaseOrderDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('purchaseorderview', ['id' => $request->purchase_order_id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function purchaseorderdetaildelete(Request $request)
    {
        if(!is_null($request->id)){
            $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($request->id);
            $purchaseOrderDetail->delete();

            return redirect()->route('purchaseorderview', ['id' => $request->po_id]);
        }
        
    }
}
