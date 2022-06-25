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
        // $delivery = DB::table('tbt_delivery_details')
        //             ->where('delivery_id','=',$request->delivery_id)
        //             ->where('item_id','=',$request->item_id)
        //             ->where('deleted_at','<>',null)
        //             ->get();

         
        //dd($request);
        // $delivery = Delivery::findOrFail($request->delivery_id);
        // dd($delivery->id);
        //dd($delivery->deliveryDetails->where('delivery_id', $request->delivery_id)->sum('quantity'));
        //dd($delivery->TotalDeliveredItems($request->item_id)->sum('quantity'));
        //dd($delivery);
        // dd($delivery->TotalDeliveredItems($request->delivery_id)->sum('quantity'));
        //dd($delivery->purchase_order_id);
        
        //CHECK IF DR DETAIL (TOTAL QTY in Multiple DR)
        $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($request->purchase_order_detail_id);
        
        //Overall Total DR Qty (in every DR)
        $total_DR_QTY = $purchaseOrderDetail->purchaseOrder->TotalDeliveries->where('item_id', $request->item_id)->sum('quantity');

        //Original PO Detail QTY
        $total_PO_QTY = $purchaseOrderDetail->quantity;

        //Input PO QTY
        $Input_PO_QTY = $request->quantity;

        //Add the current DR QTY to Input PO QTY
        $total_QTY_DR_PO = $total_DR_QTY + $Input_PO_QTY;

        //CHECK IF "PO DETAIL ITEM" ALREADY EXIST IN "DR DETAIL ITEM" 
        $deliveryDetail = DeliveryDetail::where('delivery_id','=', $request->delivery_id)
        ->where('item_id','=', $request->item_id)
        ->get();

        if($deliveryDetail->isEmpty()) 
        {

            if ($total_QTY_DR_PO <= $total_PO_QTY) 
            {

                list($validator, $record, $success) = LogicCRUD::saveRecord('DeliveryDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
                if ($success) {
                    return redirect()->route('deliveryview', ['id' => $request->delivery_id]);
                } else {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

            } else{
                return redirect()->back()->withErrors(['msg' => 'Invalid transaction, Quantity is over Purchase Request!']);
            }


        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid transaction, Duplicate item on delivery']);
        }
    }

    public function deliverydetailupdate(Request $request)
    {
        
        $deliveryDetail = DeliveryDetail::findOrFail($request->id);
        //Current DR QTY
        $Current_DR_QTY = $deliveryDetail->quantity;

        //CHECK IF DR DETAIL (TOTAL QTY in Multiple DR)
        $purchaseOrderDetail = PurchaseOrderDetail::findOrFail($request->purchase_order_detail_id);

        //Overall DR Qty (Multiple DR)
        $Overall_DR_QTY = $purchaseOrderDetail->purchaseOrder->TotalDeliveries->where('item_id', $request->item_id)->sum('quantity');

        //Original PO Detail QTY
        $Original_PO_QTY = $purchaseOrderDetail->quantity;

        //Input PO QTY
        $Input_DR_QTY = $request->quantity;    
        //Input DR QTY - Current DR QTY
        $total_DR_QTY = $Input_DR_QTY - $Current_DR_QTY;
        //Total DR QTY + Overall DR QTY
        $Final_DR_QTY = $total_DR_QTY + $Overall_DR_QTY;

        if ($Original_PO_QTY >= $Final_DR_QTY) 
        {
            list($validator, $record, $success) = LogicCRUD::saveRecord('DeliveryDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
            if ($success){
                return redirect()->route('deliveryview', ['id' => $request->delivery_id]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } else{
            return redirect()->back()->withErrors(['msg' => 'Invalid transaction, Quantity is over Purchase Request!']);
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
