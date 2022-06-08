<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transaction\PurchaseOrder;
use App\Master\Contractor;
use App\Master\Supplier;
use App\Master\Location;

use App\System\LogicCRUD;

class PurchaseOrderController extends Controller
{
    public function purchaseorderview(Request $request)
    {
        if(isset($request->id)) {
            return view('transaction.purchaseorder.purchaseorderform', [
                'purchaseOrder' => LogicCRUD::retrieveRecord('PurchaseOrder', 'Transaction', $request->id),
                'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
                'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', $id = null, $limitter = null, $active = true),
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
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
            'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
            'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', $id = null, $limitter = null, $active = true),
            'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
            'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true)
        ]);
    }

    public function purchaseorderupdate(Request $request)
    {
        if(!is_null($request->id)) {
            if(PurchaseOrder::findorFail($request->id)){
                return view('transaction.purchaseorder.purchaseorderform', [
                    'purchaseOrder' => LogicCRUD::retrieveRecord('PurchaseOrder', 'Transaction', $request->id),
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

    public function purchaseordersave(Request $request)
    {
        if(is_null($request->id)) {
            $request['prepared_by_id'] = Auth::id();
        }
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('PurchaseOrder', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('purchaseorderupdate', ['id' => $record->id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function purchaseorderdelete(Request $request)
    {
        
    }   
}
