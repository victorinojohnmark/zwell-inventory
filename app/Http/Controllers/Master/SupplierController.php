<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\System\LogicCRUD;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:supplier-view', ['only' => ['supplierview']]);
        $this->middleware('permission:supplier-create', ['only' => ['suppliercreate']]);
        $this->middleware('permission:supplier-save', ['only' => ['suppliersave']]);
    }

    //supplierview
    public function supplierview(Request $request)
    {
        if(isset($request->id)) {
            return view('master.supplier.supplierform', [
                'supplier' => LogicCRUD::retrieveRecord('Supplier', 'Master', $request->id)
            ]);
        } 

        else {
            return view('master.supplier.supplierlist', [
                'suppliers' => LogicCRUD::retrieveRecord('Supplier', 'Master', null)
            ]);
        }
    }

    public function suppliercreate()
    {
        return view('master.supplier.supplierform', [
            'supplier' => LogicCRUD::createRecord('Supplier', 'Master'),
        ]);
    }

    public function suppliersave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('Supplier', 'Master', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('supplierview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function supplierdelete()
    {
        //
    }

}
