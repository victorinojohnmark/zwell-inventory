<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\System\LogicCRUD;
use App\Transaction\Delivery;
use App\Transaction\DeliveryDetail;
use App\Transaction\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function deliveryview(Request $request)
    {
        if(isset($request->id)) {
            return view('transaction.delivery.deliveryform', [
                'delivery' => LogicCRUD::retrieveRecord('Delivery', 'Transaction', $request->id),
                'purchaseOrders' => PurchaseOrder::doesnthave('deliveries')->where('approved_by_id','!=', 0)->get(),
                'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
                'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', $id = null, $limitter = null, $active = true),
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
            ]);
        } 

        else {
            return view('transaction.delivery.deliverylist', [
                'deliveries' => LogicCRUD::retrieveRecord('Delivery', 'Transaction', null)
            ]);
        }
    }

    public function deliverycreate()
    {
        return view('transaction.delivery.deliveryform', [
            'delivery' => LogicCRUD::createRecord('Delivery', 'Transaction'),
            'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
            'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', $id = null, $limitter = null, $active = true),
            'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
            'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
        ]);
    }

    public function deliveryupdate(Request $request)
    {
        if(!is_null($request->id)) {
            if(Delivery::findorFail($request->id)){
                return view('transaction.delivery.deliveryform', [
                    'delivery' => LogicCRUD::retrieveRecord('Delivery', 'Transaction', $request->id),
                    'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
                    'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', $id = null, $limitter = null, $active = true),
                    'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
                    'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
                ]);
            } else {
                return response(['error' => true, 'error-msg' => 'Not Found'], 404);
            }
            
        } else {
            return redirect()->back();
        }

    }

    public function deliverysave(Request $request)
    {   
        //check PO is already completed delivery
        $purchaseOrder = PurchaseOrder::findOrFail($request->purchase_order_id);
        if($purchaseOrder->delivery_status['title'] == 'Complete Delivery') {
            return redirect()->back()->withErrors(['Invalid Transaction, Selected PO already has complete delivery']);
        }

        //delete delivery details of PO id changed
        if(!is_null($request->id)) {
            $delivery = Delivery::findOrFail($request->id);
            if(($delivery->purchase_order_id) <> ($request->purchase_order_id)) {
                foreach ($delivery->deliveryDetails as $deliveryDetail) {
                    $deliveryDetail->delete();
                }
            }
        } 
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('Delivery', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('deliveryview', ['id' => $record->id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function deliverydelete(Request $request)
    {
        
    }   

    public function deliveryconfirm(Request $request)
    {
        $delivery = Delivery::findOrFail($request->id);

        if($delivery) {
            if(count($delivery->deliveryDetails)){
                $delivery->complete_status = true;
                $delivery->save();
                return redirect()->route('deliveryview', ['id' => $request->id]);
            } else {
                return redirect()->back()->withErrors(['Please add items before confirming']);
            }
        }
    } 

    public function deliverydraft(Request $request)
    {
        $delivery = Delivery::findOrFail($request->id);
        if($delivery) {
            $delivery->complete_status = false;
            $delivery->save();
            return redirect()->route('deliveryview', ['id' => $request->id]);
        }
        
    }
}
