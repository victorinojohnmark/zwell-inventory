<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Master\Item;

use App\Transaction\ReleaseDetail;

use App\System\LogicCRUD;

class ReleaseDetailController extends Controller
{

    public function releasedetailsave(Request $request)
    {
        $isItemExist = ReleaseDetail::where([['release_id', $request->release_id],['item_id', $request->item_id]])->count();

        //check if item already exist in release details - new record transaction
        if($isItemExist && is_null($request->id)) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, Item already exist - update the item instead.']);
        }

        //total release entry - regardless with the complete_status
        $item = Item::find($request->item_id);

        if($item->total_stock($request->location) <= 0) {
            return redirect()->back()->withErrors(['error' => 'Transaction invalid, No stock remaining for '.$item->item_name]);
        }

        $releaseDetail = ReleaseDetail::find($request->id);
        $totalReleaseEntry = $item->total_release_entry($request->location_id);
        $currentReleaseEntry = isset($request->id) ? ($totalReleaseEntry - $releaseDetail->quantity) + $request->quantity : $totalReleaseEntry + $request->quantity;

        if($currentReleaseEntry <= $item->total_delivery_completed($request->location_id)) {
            //Transaction
            list($validator, $record, $success) = LogicCRUD::saveRecord('ReleaseDetail', 'Transaction', $request->all(), $request->id, $request->id ? 'updated' : 'created');
            if ($success){
                return redirect()->route('releaseview', ['id' => $record->release_id]);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['msg' => 'Quantity entry exceeded based on current stock of '.$item->item_name]);
        }
        
    } 

    public function releasedetaildelete(Request $request)
    {
        
    } 
}
