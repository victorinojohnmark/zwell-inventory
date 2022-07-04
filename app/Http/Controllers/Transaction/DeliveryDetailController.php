<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\System\LogicCRUD;
use App\Transaction\Delivery;
use App\Transaction\DeliveryDetail;
use App\Transaction\PurchaseOrder;
use App\Transaction\PurchaseOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryDetailController extends Controller
{
    
    public function deliverydetailsave(Request $request)
    {
       
        //Check total delivered item
        $purchaseOrderDetail = PurchaseOrderDetail::find($request->purchase_order_detail_id);
        if(is_null($purchaseOrderDetail)) {
            return redirect()->back()->withErrors(['msg' => 'Invalid transaction, Please select item']);
        }

        $totalDeliveryEntry = $purchaseOrderDetail->purchaseOrder->total_delivery_per_item($request->item_id);

        //Check item if already existed in DR, duplicate entry validation 
        $isItemExist = DeliveryDetail::where([['delivery_id', $request->delivery_id],['item_id', $request->item_id]])->count();

        if($isItemExist && is_null($request->id)) {
            return redirect()->back()->withErrors(['msg' => 'Invalid transaction, Duplicate item on delivery - update the item instead']);
        } else {

            //find delivery detail 
            $deliveryDetail = DeliveryDetail::find($request->id);
            $currentTotalDeliveryEntry = is_null(isset($deliveryDetail->id)) ? ($totalDeliveryEntry - $deliveryDetail->quantity) + $request->quantity : ($totalDeliveryEntry + $request->quantity);
            
            if ($currentTotalDeliveryEntry <= $purchaseOrderDetail->quantity) { 

                list($validator, $record, $success) = LogicCRUD::saveRecord('DeliveryDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
                if ($success) {
                    return redirect()->route('deliveryview', ['id' => $request->delivery_id]);
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

            } else{
                return redirect()->back()->withErrors(['msg' => 'Quantity input exceeded over expected max quantity entrie/s for the selected item']);
            }
        }
    }

    public function deliverydetaildelete(Request $request)
    {
        // dd($request->id);
        $deliveryDetail = DeliveryDetail::findOrFail($request->id);
        $deliveryDetail->delete();
        
        
        return redirect()->route('deliveryview', ['id' => $request->dr_id]);
        
    }
}
