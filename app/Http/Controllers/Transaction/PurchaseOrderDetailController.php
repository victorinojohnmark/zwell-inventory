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
        $purchaseOrder = PurchaseOrder::findOrFail($request->purchase_order_id);
        if($purchaseOrder && $purchaseOrder->complete_status) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, Purchase Order already completed.']);
        }

        //check if item already exist in PO
        if($purchaseOrder && $purchaseOrder->purchaseorderDetails->where('item_id', $request->item_id)->count() && $request->id == null) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, Item already exist in PO Details - update the item instead.']);
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
