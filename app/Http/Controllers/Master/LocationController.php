<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\System\LogicCRUD;

class LocationController extends Controller
{
    public function locationview(Request $request)
    {
        if(isset($request->id)) {
            return view('master.location.locationform', [
                'location' => LogicCRUD::retrieveRecord('Location', 'Master', $request->id),
                'companies' => LogicCRUD::retrieveRecord('Company', 'Master', $id = null, $limitter = null, $active = true),
            ]);
        } 

        else {
            return view('master.location.locationlist', [
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', null, 50)
            ]);
        }
    }

    public function locationcreate()
    {
        return view('master.location.locationform', [
            'location' => LogicCRUD::createRecord('Location', 'Master'),
            'companies' => LogicCRUD::retrieveRecord('Company', 'Master', $id = null, $limitter = null, $active = true),
        ]);
    }

    public function locationupdate(Request $request)
    {
        if(!is_null($request->id)) {
            return view('master.location.locationform', [
                'location' => LogicCRUD::retrieveRecord('Location', 'Master', $request->id),
                'companies' => LogicCRUD::retrieveRecord('Company', 'Master', $id = null, $limitter = null, $active = true),
            ]);
        } else {
            return redirect()->back();
        }

        
    }

    public function locationsave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;
        
        list($validator, $record, $success) = LogicCRUD::saveRecord('Location', 'Master', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('locationview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function locationdelete()
    {

    }
}
