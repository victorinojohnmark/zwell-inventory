<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\System\LogicCRUD;
use App\System\LogicCONF;

use App\Master\Item;

class ItemController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:item-view', ['only' => ['itemview']]);
        $this->middleware('permission:item-create', ['only' => ['itemcreate']]);
        $this->middleware('permission:item-save', ['only' => ['itemsave']]);
    }

    public function itemview(Request $request)
    {
        if(isset($request->id)) {
            return view('master.item.itemform', [
                'units' => LogicCONF::getDropDownJson('units.json'),
                'item' => LogicCRUD::retrieveRecord('Item', 'Master', $request->id)
            ]);
        } 

        else {
            return view('master.item.itemlist', [
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', null)
            ]);
        }
    }

    public function itemcreate()
    {
        return view('master.item.itemform', [
            'units' => LogicCONF::getDropDownJson('units.json'),
            'item' => LogicCRUD::createRecord('Item', 'Master'),
        ]);
    }

    public function itemsave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;

        list($validator, $record, $success) = LogicCRUD::saveRecord('Item', 'Master', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            return redirect()->route('itemview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function itemdelete()
    {

    }

    public function itemgetunit(Request $request)
    {
        if(!is_null($request->id)){
            $item = Item::findOrFail($request->id);

            return $item->unit;
        }
    }
}
