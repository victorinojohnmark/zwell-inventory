<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function deliveryview(Request $request)
    {
        if(isset($request->id)) {
            return view('transaction.delivery.deliveryform', [
                'delivery' => LogicCRUD::retrieveRecord('Delivery', 'Transaction', $request->id),
                'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
                'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', $id = null, $limitter = null, $active = true),
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
            ]);
        } 

        else {
            return view('transaction.delivery.deliverylist', [
                'purchaseOrders' => LogicCRUD::retrieveRecord('Delivery', 'Transaction', null, 50)
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
            if(PurchaseOrder::findorFail($request->id)){
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
        if(is_null($request->id)) {
            $request['prepared_by_id'] = Auth::id();
        }
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('Delivery', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('purchaseorderupdate', ['id' => $record->id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function deliverydelete(Request $request)
    {
        
    }   
}
