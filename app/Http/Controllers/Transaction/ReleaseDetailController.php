<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Transaction\ReleaseDetail;
use App\Transaction\Release;

use App\System\LogicCRUD;

class ReleaseDetailController extends Controller
{

    public function releasedetailsave(Request $request)
    {

        $release = Release::findOrFail($request->release_id);
        $releaseDetail = ReleaseDetail::findOrFail($request->id);

        //check if item already exist in release
        if($release && $release->releaseDetails->where('item_id', $request->item_id)->count() && $request->id == null) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, Item already exist - update the item instead.']);
        }

        dd($releaseDetail->item->total_delivery_completed);

        

        //Transaction
        list($validator, $record, $success) = LogicCRUD::saveRecord('ReleaseDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
        if ($success){
            return redirect()->route('releaseview', ['id' => $record->release_id]);
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    } 

    public function releasedetaildelete(Request $request)
    {
        
    } 
}
