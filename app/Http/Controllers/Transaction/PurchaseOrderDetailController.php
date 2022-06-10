<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transaction\PurchaseOrderDetail;
use App\Transaction\PurchaseOrder;

use App\System\LogicCRUD;

class PurchaseOrderDetailController extends Controller
{
    public function purchaseorderdetailsave(Request $request)
    {
        //check first if PO exist and is already completed
        $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($request->id);
        if($purchaseOrderDetail && $purchaseOrderDetail->purchaseOrder->complete_status) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, Purchase Order already completed.']);
        }

        //Transaction
        list($validator, $record, $success) = LogicCRUD::saveRecord('PurchaseOrderDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
        if ($success){
            return redirect()->route('purchaseorderview', ['id' => $request->purchase_order_id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
    }

    public function purchaseorderdetaildelete(Request $request)
    {
        //check first if PO exist and is already completed
        $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($request->id);
        if($purchaseOrderDetail && $purchaseOrderDetail->purchaseOrder->complete_status) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, Purchase Order already completed.']);
        }

        $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($request->id);
        $purchaseOrderDetail->delete();

        return redirect()->route('purchaseorderview', ['id' => $request->po_id]);
        
    }
}
