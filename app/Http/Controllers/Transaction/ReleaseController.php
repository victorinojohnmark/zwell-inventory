<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transaction\Release;

use App\System\LogicCRUD;

class ReleaseController extends Controller
{
    public function releaseview(Request $request)
    {
        if(isset($request->id)) {
            return view('transaction.release.releaseform', [
                'release' => LogicCRUD::retrieveRecord('Release', 'Transaction', $id = $request->id),
                'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true),
            ]);
        } 

        else {
            return view('transaction.release.releaselist', [
                'releases' => LogicCRUD::retrieveRecord('Release', 'Transaction', null, 50)
            ]);
        }
    }

    public function releasecreate()
    {
        return view('transaction.release.releaseform', [
            'release' => LogicCRUD::createRecord('Release', 'Transaction'),
            'contractors' => LogicCRUD::retrieveRecord('Contractor', 'Master', $id = null, $limitter = null, $active = true),
            'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true),
            'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true),
        ]);
    }

    public function releasesave(Request $request)
    {
        if(!is_null($request->id)) {
            $release = Release::findOrFail($request->id);
            if($release && $release->complete_status) {
                return redirect()->back()->withErrors(['error' => 'Transaction invalid, Release already completed.']);
            }
        }

        //delete release details of location id changed
        if(!is_null($request->id)) {
            $release = Release::findOrFail($request->id);
            if(($release->location_id) <> ($request->location_id)) {
                foreach($release->releaseDetails as $releaseDetail) {
                    $releaseDetail->delete();
                }
            }
        }

        //Transaction
        list($validator, $record, $success) = LogicCRUD::saveRecord('Release', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
        if ($success){
            return redirect()->route('releaseview', ['id' => $record->id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function releaseconfirm(Request $request)
    {
        $release = Release::findOrFail($request->id);

        if($release) {
            if(count($release->releaseDetails)){
                $release->complete_status = true;
                $release->save();
                return redirect()->route('releaseview', ['id' => $request->id]);
            } else {
                return redirect()->back()->withErrors(['Please add items before confirming']);
            }
        }
    }

    public function releasedraft(Request $request)
    {
        $release = Release::findOrFail($request->id);
        if($release) {
            $release->complete_status = false;
            $release->save();
            return redirect()->route('releaseview', ['id' => $request->id]);
        }
        
    }
}
