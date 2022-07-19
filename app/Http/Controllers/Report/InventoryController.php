<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\System\LogicCRUD;
use app\Master\Item;

class InventoryController extends Controller
{
    public function stockview(Request $request)
    {

        if(isset($request->location_id)) {
            return view('report.inventory.stocklist', [
                'location_id' => $request->location_id,
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true, $paginated = false),
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true, $paginated = false),
            ]);
        } else {
            return view('report.inventory.stocklist', [
                'locations' => LogicCRUD::retrieveRecord('Location', 'Master', $id = null, $limitter = null, $active = true, $paginated = false),
                'items' => LogicCRUD::retrieveRecord('Item', 'Master', $id = null, $limitter = null, $active = true, $paginated = false)
            ]);
        }
        
    }

}
