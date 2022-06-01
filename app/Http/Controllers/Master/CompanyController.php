<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Company;

use App\System\LogicCRUD;

class CompanyController extends Controller
{
    public function companyview(Request $request)
    {
        if(isset($request->id)) {
            return view('master.company.companyform', [
                'company' => LogicCRUD::retrieveRecord('Company', 'Master', $request->id)
            ]);
        } 

        else {
            return view('master.company.companylist', [
                'companies' => LogicCRUD::retrieveRecord('Company', 'Master', null, 50)
            ]);
        }
    }

    public function companycreate()
    {
        return view('master.company.companyform', [
            'company' => LogicCRUD::createRecord('Company', 'Master'),
        ]);
    }

    public function companyupdate(Request $request)
    {
        if(!is_null($request->id)) {
            return view('master.company.companyform', [
                'company' => LogicCRUD::retrieveRecord('Company', 'Master', $request->id),
            ]);
        } else {
            return redirect()->back();
        }

        
    }

    public function companysave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('Company', 'Master', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('companyview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function companydelete()
    {

    }
}
