<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\System\LogicCRUD;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function contractorview(Request $request){
        if(isset($request->id)) {
            return view('master.contractor.contractorform', [
                'contractor' => LogicCRUD::retrieveRecord('Contractor', 'Master', $request->id)
            ]);
        } 

        else {
            return view('master.contractor.contractorlist', [
                'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', null, 50)
            ]);
        }
    }

    
    public function contractorcreate()
    {
        return view('master.contractor.contractorform', [
            'contractor' => LogicCRUD::createRecord('Contractor', 'Master'),
        ]);
    }

    public function contractorsave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('Contractor', 'Master', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('contractorview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function contractorupdate(Request $request)
    {
        if(!is_null($request->id)) {
            return view('master.contractor.contractorform', [
                'contractor' => LogicCRUD::retrieveRecord('Contractor', 'Master', $request->id),
            ]);
        } else {
            return redirect()->back();
        }
    }


    public function contractordelete()
    {
        //
    }
}
